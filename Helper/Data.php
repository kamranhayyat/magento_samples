<?php

namespace Kamran\CustomExt\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {   

    protected $registry;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->registry = $registry;
        $this->scopeConfig = $scopeConfig;
    }

    public function getCurrentProduct() {
        return $this->registry->registry('current_product');
    }

    public function getProductLabelSettings() {
        return $this->scopeConfig->getValue('productlabelsettings/general_settings/enable_disable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);   
    }

    public function getProductLabelBGColor() {
        return $this->scopeConfig->getValue('productlabelsettings/general_settings/product_label_hexcode', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);   
    }
    
}
