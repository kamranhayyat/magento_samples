<?php

namespace Kamran\CustomExt\Plugin;

class ProductDataProviderAfter {

    protected $helper;

    public function __construct(
        \Kamran\CustomExt\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    public function afterGetMeta(\Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider $subject, $result) {
        $result['product_label_attribute_fieldset']['arguments']['data']['config']['visible'] = $this->helper->getProductLabelSettings() ? 1 : 0;
        return $result;
    }

}
