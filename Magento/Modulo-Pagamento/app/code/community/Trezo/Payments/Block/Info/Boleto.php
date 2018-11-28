<?php
/**
 *
 * @category   Trezo
 * @package    Trezo_Payments
 * @author     Rone Clay Santos <https://github.com/roneclay>
 *
 */

class Trezo_Payments_Block_Info_Boleto extends Mage_Payment_Block_Info {

    /**
     *
     */
    protected function _construct() {
		parent::_construct();
		$this->setTemplate( 'trezo/info/boleto.phtml' );
	}

    /**
     * @param null $transport
     * @return Varien_Object
     */
    protected function _prepareSpecificInformation($transport = null) {
		if (null !== $this->_paymentSpecificInformation) {
			return $this->_paymentSpecificInformation;
		}
		$data      = array();
		$transport = parent::_prepareSpecificInformation($transport);

		return $transport->setData(array_merge($data, $transport->getData()));
	}
}