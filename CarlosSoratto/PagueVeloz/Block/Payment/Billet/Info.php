<?php

namespace CarlosSoratto\PagueVeloz\Block\Payment\Billet;

use Magento\Payment\Block\Info as MagentoPaymentInfo;
use Magento\Framework\DataObject;

class Info extends MagentoPaymentInfo
{
    const TEMPLATE = 'CarlosSoratto_PagueVeloz::payment/info/billet.phtml';

    public function _construct()
    {
        $this->setTemplate(self::TEMPLATE);
    }

    /**
     * Send specific information for order details
     * @param null $transport
     * @return DataObject|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        if ($this->_paymentSpecificInformation !== null) {
            return $this->_paymentSpecificInformation;
        }
        $paymentInfo = $this->getInfo()->getAdditionalInformation();

        if (isset($paymentInfo['billet_url'])) {
            $transport = new DataObject([
                (string)__('Print Billet') => $paymentInfo['billet_url'],
                'Billet Id' => $paymentInfo['billet_id']
            ]);
        }
        $transport = parent::_prepareSpecificInformation($transport);
        return $transport;
    }
}
