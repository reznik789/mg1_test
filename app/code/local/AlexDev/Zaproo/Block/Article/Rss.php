<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:34 PM
 */
class AlexDev_Zaproo_Block_Article_Rss
    extends Mage_Rss_Block_Abstract
{
    const CACHE_TAG = 'block_html_news_article_rss';

    protected function _construct()
    {
        $this->setCacheTags(array(self::CACHE_TAG));
        /*
        * setting cache to save the rss for 10 minutes
        */
        $this->setCacheKey('zaproo_article_rss');
        $this->setCacheLifetime(600);
    }

    protected function _toHtml()
    {
        $url = Mage::helper('zaproo/article')->getArticlesUrl();
        $title = Mage::helper('zaproo')->__('Articles');
        $rssObj = Mage::getModel('rss/rss');
        $data = array(
            'title' => $title,
            'description' => $title,
            'link' => $url,
            'charset' => 'UTF-8',
        );
        $rssObj->_addHeader($data);
        $collection = Mage::getModel('zaproo/article')->getCollection()
            ->addFieldToFilter('status', 1)
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('in_rss', 1)
            ->setOrder('created_at');
        $collection->load();
        foreach ($collection as $item) {
            $description = '<p>';
            $description .= '<div>' . Mage::helper('zaproo')->__('Title') . ': ' . $item->getTitle() . '</div>';
            $description .= '<div>' . Mage::helper('zaproo')->__('Short description') . ': ' . $item->getShortDescription() . '</div>';
            $description .= '<div>' . Mage::helper('zaproo')->__('Description') . ': ' . $item->getDescription() . '</div>';
            $description .= '<div>' . Mage::helper('zaproo')->__('Publish Date') . ': ' . Mage::helper('core')->formatDate($item->getPublishDate(), 'full') . '</div>';
            $description .= '</p>';
            $data = array(
                'title' => $item->getTitle(),
                'link' => $item->getArticleUrl(),
                'description' => $description
            );
            $rssObj->_addEntry($data);
        }
        return $rssObj->createRssXml();
    }
}