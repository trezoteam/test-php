<?php

namespace CarlosSoratto\PagueVeloz\Model;

use Magento\Store\Model\ScopeInterface;
use Magento\Directory\Helper\Data as DirectoryHelper;
use CarlosSoratto\PagueVeloz\Helper\HttpFactory as HttpClient;
use CarlosSoratto\PagueVeloz\Block\Payment\Billet as BilletBlocks;
use CarlosSoratto\PagueVeloz\Helper\Data as PagueVelozHelper;

class Payment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const URL_PAYMENT = 'https://sandbox.pagueveloz.com.br/';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = 'billet';
    protected $client;

    private $params = array();

    public $pagueVelozHelper;

    protected $_infoBlockType = BilletBlocks\Info::class;

    /**
     * Payment constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory
     * @param \Magento\Payment\Helper\Data $paymentData
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Payment\Model\Method\Logger $logger
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     * @param DirectoryHelper|null $directory
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        DirectoryHelper $directory = null
    ) {
        $this->client = HttpClient::make();
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $resource,
            $resourceCollection,
            $data,
            $directory
        );
    }

    /**
     * Determine method availability based on quote amount and config data
     *
     * @param \Magento\Quote\Api\Data\CartInterface|null $quote
     * @return bool
     */
    public function isAvailable(\Magento\Quote\Api\Data\CartInterface $quote = null)
    {
        if (!$this->getValueConfig('email_api')
            || !$this->getValueConfig('token_api')
            || !$this->getValueConfig('expiration')) {
            return false;
        }

        return parent::isAvailable($quote);
    }

    /**
     * Get config payment action url
     * Used to universalize payment actions when processing payment place
     *
     * @return string
     */
    public function getConfigPaymentAction()
    {
        return self::ACTION_ORDER;
    }

    /**
     * All the functionality and execution of the payment module.
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function order(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        $expiration = $this->getValueConfig('expiration');

        $order = $payment->getOrder();

        $this->validarCPFCNPJSacado($order->getData('customer_taxvat'));

        $this->params['body']['Sacado'] = $order->getData('customer_email');
        $this->params['body']['CPFCNPJSacado'] = preg_replace('/\D/', '', $order->getData('customer_taxvat'));
        $this->params['body']['Vencimento'] = date('d/m/Y', strtotime(date('Y-m-d', strtotime("+".$expiration." days"))));
        $this->params['body']['Valor'] = number_format($order->getGrandTotal(), 2, '.', '');
        $this->params['body']['SeuNumero'] = $order->getData('increment_id');
        $this->params['body']['Parcela'] = '1';
        $this->params['body']['Linha1'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dapibus lacus in dolor viverra facilisis.';
        $this->params['body']['Linha2'] = 'Quisque at sodales erat, quis tincidunt nunc. Suspendisse dictum faucibus auctor.';
        $this->params['body']['Email'] = $order->getData('customer_email');
        $this->params['body']['DataEnvioEmail'] =  date('d/m/Y');
        $this->params['body']['Pdf'] = 'false';

        $url = self::URL_PAYMENT.'api/v5/Boleto';

        try {
            $email_api = $this->getValueConfig('email_api');
            $token_api = $this->getValueConfig('token_api');
            $authentication = base64_encode($email_api.':'.$token_api);
            $this->params['headers']['Content-Type'] = 'application/json';
            $this->params['headers']['Authorization'] = 'Basic '.$authentication;

            $response = $this->client->request(
                'POST',
                $url,
                [
                    'headers' => $this->params['headers'],
                    'body' => \json_encode($this->params['body'])
                ]
            );

            $resposta = \json_decode($response->getBody());

            $payment->setAdditionalInformation('billet_id', $resposta->Id);
            $payment->setAdditionalInformation('billet_url', $resposta->Url);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }

        return $this;
    }

    /**
     * Get value on config
     * @param $field
     * @return mixed
     */
    public function getValueConfig($field)
    {
        return $this->_scopeConfig->getValue('payment/billet/'.$field, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Function to validate CPF/CNPJ on the client
     * @param $taxvat
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function validarCPFCNPJSacado($taxvat)
    {
        try {
            if (!PagueVelozHelper::validarCPF($taxvat)
                && !PagueVelozHelper::validarCnpj($taxvat)) {
                throw new \Magento\Framework\Exception\LocalizedException(__('Por favor, preencha o "CPF/CNPJ" corretamente.'));
            }
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }
    }
}
