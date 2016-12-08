<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 2:38 PM
 */
class AlexDev_Zaproo_Block_Rss
    extends Mage_Core_Block_Template
{
    protected $_feeds = array();

    public function addFeed($label, $url, $prepare = false)
    {
        $link = ($prepare ? $this->getUrl($url) : $url);
        $feed = new Varien_Object();
        $feed->setLabel($label);
        $feed->setUrl($link);
        $this->_feeds[$link] = $feed;
        return $this;
    }

    public function getFeeds()
    {
        return $this->_feeds;
    }
}