<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:22 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Attribute_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('article_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('zaproo')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label' => Mage::helper('zaproo')->__('Properties'),
            'title' => Mage::helper('zaproo')->__('Properties'),
            'content' => $this->getLayout()->createBlock('zaproo/adminhtml_article_attribute_edit_tab_main')->toHtml(),
            'active' => true
        ));
        $this->addTab('labels', array(
            'label' => Mage::helper('zaproo')->__('Manage Label / Options'),
            'title' => Mage::helper('zaproo')->__('Manage Label / Options'),
            'content' => $this->getLayout()->createBlock('zaproo/adminhtml_article_attribute_edit_tab_options')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}