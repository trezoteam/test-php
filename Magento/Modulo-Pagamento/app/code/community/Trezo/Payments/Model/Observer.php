<?php
/**
*  @category   Trezo
*  @package    Trezo_Payments
*  @author     Rone Clay Santos <https://github.com/roneclay>
*/

class Trezo_Payments_Model_Observer
{

	/**
	 * @param Varien_Event_Observer $observer
	 *
	 * @return $this|Trezo_Payments_Model_Api
	 */
	public function checkTrezoPaymentMethod(Varien_Event_Observer $observer)
    {
        $order           = $observer->getEvent()->getOrder();
        $_payment_method = $order->getPayment()->getMethod();

        if (strpos($_payment_method, 'trezo') !== false) {
            $_trezo_method  = explode("_", $_payment_method);
            $_payment_model = 'trezo/' . $_trezo_method[1];
            $order_data     = $order->getData();

            Mage::getModel($_payment_model)->_place($order_data);

            if ($trezo_payment = Mage::getSingleton('checkout/session')->getTrezoPayment()) {
                $order->setTrezoPayment( $trezo_payment );
                Mage::getSingleton('checkout/session')->unsTrezoPayment();
            }
        }

        return $this;
    }

}

