<?php
/**
 *
 * @category   Trezo
 * @package    Trezo_Payments
 * @author     Rone Clay Santos <https://github.com/roneclay>
 *
 */

class Trezo_Payments_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @param $_orderId
     * @return bool
     */
    public function getOrderBoletoUrl($_orderId)
    {
	    $_order = Mage::getModel('sales/order')->load($_orderId);
	    if (!$_order->getId() || !$_order->getTrezoPayment())
	    	return false;

	    $payment = json_decode($_order->getTrezoPayment(), true);
	    if (!isset($payment['Url']))
	    	return false;

	    return $payment['Url'];
    }
}