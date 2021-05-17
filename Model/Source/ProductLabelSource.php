<?php
namespace Kamran\CustomExt\Model\Source;

class ProductLabelSource extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    protected $_optionsData;

    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => 'Hot', 'label' => __('Hot')],
                ['value' => 'Trending', 'label' => __('Trending')],
                ['value' => 'New', 'label' => __('New')],
            ];
        }
        return $this->_options;
    }

    final public function toOptionArray()
    {
        return [
            ['value' => 'Hot', 'label' => __('Hot')],
            ['value' => 'Trending', 'label' => __('Trending')],
            ['value' => 'New', 'label' => __('New')],
        ];
    }
}