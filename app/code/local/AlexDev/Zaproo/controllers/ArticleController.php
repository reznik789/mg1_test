<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:51 PM
 */
class AlexDev_Zaproo_ArticleController
    extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('zaproo/article')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb('home', array(
                        'label' => Mage::helper('zaproo')->__('Home'),
                        'link' => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb('articles', array(
                        'label' => Mage::helper('zaproo')->__('Articles'),
                        'link' => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle(Mage::getStoreConfig('zaproo/article/meta_title'));
            $headBlock->setKeywords(Mage::getStoreConfig('zaproo/article/meta_keywords'));
            $headBlock->setDescription(Mage::getStoreConfig('zaproo/article/meta_description'));
        }
        $this->renderLayout();
    }

    protected function _initArticle()
    {
        $articleId = $this->getRequest()->getParam('id', 0);
        $article = Mage::getModel('zaproo/article')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($articleId);
        if (!$article->getId()) {
            return false;
        } elseif (!$article->getStatus()) {
            return false;
        }
        return $article;
    }

    public function viewAction()
    {
        $article = $this->_initArticle();
        if (!$article) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_article', $article);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('news-article news-article' . $article->getId());
        }
        if (Mage::helper('zaproo/article')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb('home', array(
                        'label' => Mage::helper('zaproo')->__('Home'),
                        'link' => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb('articles', array(
                        'label' => Mage::helper('zaproo')->__('Articles'),
                        'link' => Mage::helper('zaproo/article')->getArticlesUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb('article', array(
                        'label' => $article->getTitle(),
                        'link' => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            if ($article->getMetaTitle()) {
                $headBlock->setTitle($article->getMetaTitle());
            } else {
                $headBlock->setTitle($article->getTitle());
            }
            $headBlock->setKeywords($article->getMetaKeywords());
            $headBlock->setDescription($article->getMetaDescription());
        }
        $this->renderLayout();
    }

    public function rssAction()
    {
        if (Mage::helper('zaproo/article')->isRssEnabled()) {
            $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
            $this->loadLayout(false);
            $this->renderLayout();
        } else {
            $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
            $this->getResponse()->setHeader('Status', '404 File not found');
            $this->_forward('nofeed', 'index', 'rss');
        }
    }
}