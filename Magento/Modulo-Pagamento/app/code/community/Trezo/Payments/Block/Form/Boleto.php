<?php 
/**
 *
 * @category   Trezo
 * @package    Trezo_Payments
 * @author     Rone Clay Santos <https://github.com/roneclay>
 *
 */

class Trezo_Payments_Block_Form_Boleto extends Mage_Payment_Block_Form
{
	protected $_instructions;

    protected function _construct()
    {
		parent::_construct();
		$this->setTemplate('trezo/form/boleto.phtml');
	}

    /**
     * @return mixed
     */
    public function getInstructions()
    {
		if (is_null($this->_instructions)) {
			$this->_instructions = $this->getMethod()->getConfigData('instructions');
		}

		return $this->_instructions;
	}
}