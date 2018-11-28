<?php
/**
 *
 * @category   Trezo
 * @package    Trezo_Payments
 * @author     Rone Clay Santos <https://github.com/roneclay>
 *
 */

class Trezo_Payments_Model_Boleto extends Mage_Payment_Model_Method_Abstract
{
    const BOLETO_END_POINT    = 'v5/Boleto';

	protected $_code          = 'trezo_boleto';
	protected $_formBlockType = 'trezo/form_boleto';
    protected $_infoBlockType = 'trezo/info_boleto';
    protected $_daysToExpire;

    /**
     * Trezo_Payments_Model_Boleto constructor.
     */
    public function __construct()
	{
		parent::__construct();
		$this->_daysToExpire = Mage::getStoreConfig('payment/trezo_boleto/days_to_expire');
	}

    /**
     * @param $order
     * @return $this
     * @throws Exception
     */
    public function _place($order)
    {
        $api = Mage::getModel('trezo/api');

        try {
            $customer = $order['customer'];
            $today    = date("d/m/Y");
            $venc_day = DateTime::createFromFormat('d/m/Y', $today);
            $venc_day->add(new DateInterval('P'.$this->_daysToExpire.'D'));

            $params = [
                'CPFCNPJSacado' => $customer->getTaxvat(),
                'DataEnvioEmail'=> $today,
                'Email'         => $customer->getEmail(),
                'Pdf'           => true,
                'Sacado'        => $customer->getFirstname() . ' ' .$customer->getLastname(),
                'Vencimento'    => $venc_day->format('d/m/Y'),
                'Valor'         => $order['grand_total'],
            ];

            $url      = $api::TREZO_END_POINT.self::BOLETO_END_POINT;
            $response = $api->prepareCurl($params, $url);
            $dataJSON = json_decode($response, true);

            if (!isset($dataJSON['Url'])) {
                $error = $dataJSON['Message'];
                Mage::getSingleton('checkout/session')->setBoletoError($error);
                throw new Exception( '[Trezo_Payments] '.$error );
            }

            Mage::getSingleton('checkout/session')->setTrezoPayment( $response);
        } catch (Exception $e) {
            throw new Exception( $e->getMessage() , 1);
        }

        return $this;
    }
}