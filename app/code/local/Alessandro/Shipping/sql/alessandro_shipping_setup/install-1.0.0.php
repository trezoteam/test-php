<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
// Add length to product attribute set
$cod = 'length';
$config = array(
    'position' => 1,
    'required' => 1,
    'label'    => 'Comprimento (cm)',
    'type'     => 'int',
    'input'    => 'text',
    'apply_to' => 'simple,bundle,grouped,configurable',
    'default'  => 16,
    'note'     => 'Comprimento da embalagem do produto (Para cálculo de frete, mínimo de 16cm)'
);
$setup->addAttribute('catalog_product', $cod, $config);
// Add height to product attribute set
$cod = 'height';
$config = array(
    'position' => 1,
    'required' => 1,
    'label'    => 'Altura (cm)',
    'type'     => 'int',
    'input'    => 'text',
    'apply_to' => 'simple,bundle,grouped,configurable',
    'default'  => 2,
    'note'     => 'Altura da embalagem do produto (Para cálculo de frete, mínimo de 2cm)'
);
$setup->addAttribute('catalog_product', $cod, $config);
// Add width to product attribute set
$cod = 'width';
$config = array(
    'position' => 1,
    'required' => 1,
    'label'    => 'Largura (cm)',
    'type'     => 'int',
    'input'    => 'text',
    'apply_to' => 'simple,bundle,grouped,configurable',
    'default'  => 11,
    'note'     => 'Largura da embalagem do produto (Para cálculo de frete, mínimo de 11cm)'
);
$setup->addAttribute('catalog_product', $cod, $config);

$installer->endSetup();