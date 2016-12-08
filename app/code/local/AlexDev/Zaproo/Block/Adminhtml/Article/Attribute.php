<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:17 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Attribute
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_article_attribute';
        $this->_blockGroup = 'zaproo';
        $this->_headerText = Mage::helper('zaproo')->__('Manage Article Attributes');
        parent::__construct();
        $this->_updateButton('add', 'label', Mage::helper('zaproo')->__('Add New Article Attribute'));
    }
}