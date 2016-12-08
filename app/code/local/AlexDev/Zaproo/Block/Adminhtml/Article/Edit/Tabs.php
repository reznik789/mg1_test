<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:07 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('article_info_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('zaproo')->__('Article Information'));
    }

    protected function _prepareLayout()
    {
        $article = $this->getArticle();
        $entity = Mage::getModel('eav/entity_type')->load('zaproo_article', 'entity_type_code');
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')
            ->setEntityTypeFilter($entity->getEntityTypeId());
        $attributes->addFieldToFilter('attribute_code', array('nin' => array('meta_title', 'meta_description', 'meta_keywords')));
        $attributes->getSelect()->order('additional_table.position', 'ASC');

        $this->addTab('info', array(
            'label' => Mage::helper('zaproo')->__('Article Information'),
            'content' => $this->getLayout()->createBlock('zaproo/adminhtml_article_edit_tab_attributes')
                ->setAttributes($attributes)
                ->toHtml(),
        ));
        $seoAttributes = Mage::getResourceModel('eav/entity_attribute_collection')
            ->setEntityTypeFilter($entity->getEntityTypeId())
            ->addFieldToFilter('attribute_code', array('in' => array('meta_title', 'meta_description', 'meta_keywords')));
        $seoAttributes->getSelect()->order('additional_table.position', 'ASC');

        $this->addTab('meta', array(
            'label' => Mage::helper('zaproo')->__('Meta'),
            'title' => Mage::helper('zaproo')->__('Meta'),
            'content' => $this->getLayout()->createBlock('zaproo/adminhtml_article_edit_tab_attributes')
                ->setAttributes($seoAttributes)
                ->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

    public function getArticle()
    {
        return Mage::registry('current_article');
    }
}