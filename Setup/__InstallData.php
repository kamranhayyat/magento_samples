<?php

declare(strict_types=1);

namespace Kamran\CustomExt\Setup;

use Magento\Customer\Api\CustomerMetaDataInterface;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Api\Data\CategoryAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config as EavConfig;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface; 

class InstallData implements InstallDataInterface {

    protected $eavSetupFactory;
    protected $eavConfig;

    public function __construct(EavSetupFactory $eavSetupFactory, EavConfig $eavConfig) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }
    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Custom Product Attribute

        // $attributeCode = 'legacy_sku'; 
        // $typeCode = ProductAttributeInterface::ENTITY_TYPE_CODE;
        // $setId = $eavSetup->getDefaultAttributeSetId($typeCode);
        // $groupId = $eavSetup->getDefaultAttributeGroupId($typeCode, $setId);
        // $groupName = $eavSetup->getAttributeGroup($typeCode, $setId, 
        //             $groupId, 'attribute_group_name');
        // $eavSetup->addAttribute(
        //     $typeCode,
        //     $attributeCode,
        //     [
        //         'label'                         => 'Legagcy SKU',
        //         'required'                      => 0,
        //         'user_defined'                  => 1,
        //         'unique'                        => 1,
        //         'searchable'                    => 1,
        //         'visible_on_front'              => 1,
        //         'visible_in_advanced_search'    => 1,
        //         'group'                         => $groupName,
        //         'sort_order'                    => 30
        //     ]
        // );

        // Custom Category Attribute
        // $typeCode = CategoryAttributeInterface::ENTITY_TYPE_CODE;
        // $attributeCode = 'external_id';
        // $eavSetup->addAttribute(
        //     $typeCode,
        //     $attributeCode,
        //     [
        //         'label'         => 'External Id',
        //         'user_defined'  => 1,
        //         'unique'        => 1
        //     ]
        // );

        // $setId = $eavSetup->getDefaultAttributeSetId($typeCode);
        // $groupId = $eavSetup->getDefaultAttributeGroupId($typeCode, $setId);
        // $eavSetup->addAttributeToSet($typeCode, $setId, $groupId, $attributeCode);

        // Custom customer attribute
        $attributeCode = 'interests';
        $eavSetup->addAttribute(CustomerMetaDataInterface::ENTITY_TYPE_CUSTOMER, $attributeCode,
        [
            'label'         => 'Interests',
            'required'      => 0,
            'user_defined'  => 1,
            'note'          => 'Separate multiple interested with comma',
            'system'        => 0,
            'position'      => 100,
        ]);

        $eavSetup->addAttributeToSet(
            CustomerMetaDataInterface::ENTITY_TYPE_CUSTOMER,
            CustomerMetaDataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
            null,
            $attributeCode
        );

        $attribue = $this->eavConfig->getAttribute(CustomerMetaDataInterface::ENTITY_TYPE_CUSTOMER, $attributeCode);
        $attribue->setData('used_in_forms', [
            'adminhtml_customer',
            'customer_account_create',
            'customer_account_edit'
        ]);
        $attribue->getResource()->save($attribue);
    }

}