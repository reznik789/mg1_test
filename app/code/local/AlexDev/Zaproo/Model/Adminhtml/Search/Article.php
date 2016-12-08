<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 2:30 PM
 */
class AlexDev_Model_Adminhtml_Search_Article
    extends Varien_Object
{
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('zaproo/article_collection')
            ->addAttributeToFilter('title', array('like' => $this->getQuery() . '%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $article) {
            $arr[] = array(
                'id' => 'article/1/' . $article->getId(),
                'type' => Mage::helper('zaproo')->__('Article'),
                'name' => $article->getTitle(),
                'description' => $article->getTitle(),
                'url' => Mage::helper('adminhtml')->getUrl('*/news_article/edit', array('id' => $article->getId())),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}