<?php
namespace Ccastro\Frenet\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Catalog\Model\Product\Attribute\Backend\Boolean;

/**
 * Class SetupData
 * @package Ccastro\Frenet\Setup
 */
class InstallData implements InstallDataInterface
{
    const ATTRIBUTE_CODE_LENGTH = 'frenet_dimensions_length';
    const ATTRIBUTE_CODE_WIDTH = 'frenet_dimensions_width';
    const ATTRIBUTE_CODE_HEIGHT = 'frenet_dimensions_height';
    const ATTRIBUTE_CODE_DIAMETER = 'frenet_dimensions_diameter';
    const ATTRIBUTE_CODE_IS_FRAGILE = 'frenet_dimensions_is_fragile';

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * SetupData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Add additional attributes to product. Need to be editable on store level due to the
     * weight unit (that dimensions unit is derived from) is configurable on
     * store level.
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(Product::ENTITY, self::ATTRIBUTE_CODE_LENGTH, [
            'type' => 'decimal',
            'label' => 'Length',
            'input' => 'text',
            'required' => false,
            'class' => 'not-negative-amount',
            'sort_order' => 65,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'user_defined' => false,
            'apply_to' => Type::TYPE_SIMPLE
        ]);

        $eavSetup->addAttribute(Product::ENTITY, self::ATTRIBUTE_CODE_WIDTH, [
            'type' => 'decimal',
            'label' => 'Width',
            'input' => 'text',
            'required' => false,
            'class' => 'not-negative-amount',
            'sort_order' => 66,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'user_defined' => false,
            'apply_to' => Type::TYPE_SIMPLE
        ]);

        $eavSetup->addAttribute(Product::ENTITY, self::ATTRIBUTE_CODE_HEIGHT, [
            'type' => 'decimal',
            'label' => 'Height',
            'input' => 'text',
            'required' => false,
            'class' => 'not-negative-amount',
            'sort_order' => 67,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'user_defined' => false,
            'apply_to' => Type::TYPE_SIMPLE
        ]);

        $eavSetup->addAttribute(Product::ENTITY, self::ATTRIBUTE_CODE_DIAMETER, [
            'type' => 'decimal',
            'label' => 'Diameter',
            'input' => 'text',
            'required' => false,
            'class' => 'not-negative-amount',
            'sort_order' => 68,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'user_defined' => false,
            'apply_to' => Type::TYPE_SIMPLE
        ]);

        $eavSetup->addAttribute(Product::ENTITY, self::ATTRIBUTE_CODE_IS_FRAGILE, [
            'type' => 'int',
            'backend' => '',
            'source' => Boolean::class,
            'label' => 'Is Fragile',
            'input' => 'select',
            'required' => false,
            'class' => 'not-negative-amount',
            'sort_order' => 69,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'user_defined' => false,
            'apply_to' => Type::TYPE_SIMPLE
        ]);
    }
}
