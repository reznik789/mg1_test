<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:32 PM
 */
class AlexDev_Zaproo_Block_Article_List
    extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $articles = Mage::getResourceModel('zaproo/article_collection')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('status', 1);
        $articles->setOrder('title', 'asc');
        $this->setArticles($articles);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'zaproo.article.html.pager')
            ->setCollection($this->getArticles());
        $this->setChild('pager', $pager);
        $this->getArticles()->load();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}