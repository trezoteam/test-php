<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();


$installer->getConnection()->addColumn(
    Mage::getSingleton('core/resource')->getTableName('sales/order'),
    'trezo_payment',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'Trezo Payment',
    ]
);

$installer->endSetup();