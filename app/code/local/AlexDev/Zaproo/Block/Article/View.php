<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:33 PM
 */
class AlexDev_Zaproo_Block_Article_View
    extends Mage_Core_Block_Template
{
    public function getCurrentArticle()
    {
        return Mage::registry('current_article');
    }
}