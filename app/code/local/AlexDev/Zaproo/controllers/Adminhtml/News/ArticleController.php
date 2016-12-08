<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:48 PM
 */
class AlexDev_Zaproo_Adminhtml_News_ArticleController
    extends Mage_Adminhtml_Controller_Action
{
    protected function _construct()
    {
        $this->setUsedModuleName('AlexDev_Zaproo');
    }

    protected function _initArticle()
    {
        $this->_title($this->__('News'))
            ->_title($this->__('Manage Articles'));

        $articleId = (int)$this->getRequest()->getParam('id');
        $article = Mage::getModel('zaproo/article')
            ->setStoreId($this->getRequest()->getParam('store', 0));

        if ($articleId) {
            $article->load($articleId);
        }
        Mage::register('current_article', $article);
        return $article;
    }

    public function indexAction()
    {
        $this->_title($this->__('News'))
            ->_title($this->__('Manage Articles'));
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $articleId = (int)$this->getRequest()->getParam('id');

        $article = $this->_initArticle();
        if ($articleId && !$article->getId()) {
            $this->_getSession()->addError(Mage::helper('zaproo')->__('This article no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        if ($data = Mage::getSingleton('adminhtml/session')->getArticleData(true)) {
            $article->setData($data);
        }
        $this->_title($article->getTitle());
        Mage::dispatchEvent('zaproo_article_edit_action', array('article' => $article));
        $this->loadLayout();
        if ($article->getId()) {
            if (!Mage::app()->isSingleStoreMode() && ($switchBlock = $this->getLayout()->getBlock('store_switcher'))) {
                $switchBlock->setDefaultStoreName(Mage::helper('zaproo')->__('Default Values'))
                    ->setSwitchUrl($this->getUrl('*/*/*', array('_current' => true, 'active_tab' => null, 'tab' => null, 'store' => null)));
            }
        } else {
            $this->getLayout()->getBlock('left')->unsetChild('store_switcher');
        }
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $storeId = $this->getRequest()->getParam('store');
        $redirectBack = $this->getRequest()->getParam('back', false);
        $articleId = $this->getRequest()->getParam('id');
        $isEdit = (int)($this->getRequest()->getParam('id') != null);
        $data = $this->getRequest()->getPost();
        if ($data) {
            $article = $this->_initArticle();
            $articleData = $this->getRequest()->getPost('article', array());
            $article->addData($articleData);
            $article->setAttributeSetId($article->getDefaultAttributeSetId());
            if ($useDefaults = $this->getRequest()->getPost('use_default')) {
                foreach ($useDefaults as $attributeCode) {
                    $article->setData($attributeCode, false);
                }
            }
            try {
                $article->save();
                $articleId = $article->getId();
                $this->_getSession()->addSuccess(Mage::helper('zaproo')->__('Article was saved'));
            } catch (Mage_Core_Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage())
                    ->setArticleData($articleData);
                $redirectBack = true;
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError(Mage::helper('zaproo')->__('Error saving article'))
                    ->setArticleData($articleData);
                $redirectBack = true;
            }
        }
        if ($redirectBack) {
            $this->_redirect('*/*/edit', array(
                'id' => $articleId,
                '_current' => true
            ));
        } else {
            $this->_redirect('*/*/', array('store' => $storeId));
        }
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $article = Mage::getModel('zaproo/article')->load($id);
            try {
                $article->delete();
                $this->_getSession()->addSuccess(Mage::helper('zaproo')->__('The articles has been deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->getResponse()->setRedirect($this->getUrl('*/*/', array('store' => $this->getRequest()->getParam('store'))));
    }

    public function massDeleteAction()
    {
        $articleIds = $this->getRequest()->getParam('article');
        if (!is_array($articleIds)) {
            $this->_getSession()->addError($this->__('Please select articles.'));
        } else {
            try {
                foreach ($articleIds as $articleId) {
                    $article = Mage::getSingleton('zaproo/article')->load($articleId);
                    Mage::dispatchEvent('zaproo_controller_article_delete', array('article' => $article));
                    $article->delete();
                }
                $this->_getSession()->addSuccess(
                    Mage::helper('zaproo')->__('Total of %d record(s) have been deleted.', count($articleIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $articleIds = $this->getRequest()->getParam('article');
        if (!is_array($articleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('zaproo')->__('Please select articles.'));
        } else {
            try {
                foreach ($articleIds as $articleId) {
                    $article = Mage::getSingleton('zaproo/article')->load($articleId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d articles were successfully updated.', count($articleIds)));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('zaproo')->__('There was an error updating articles.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/zaproo/article');
    }

    public function exportCsvAction()
    {
        $fileName = 'articles.csv';
        $content = $this->getLayout()->createBlock('zaproo/adminhtml_article_grid')
            ->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction()
    {
        $fileName = 'article.xls';
        $content = $this->getLayout()->createBlock('zaproo/adminhtml_article_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'article.xml';
        $content = $this->getLayout()->createBlock('zaproo/adminhtml_article_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function wysiwygAction()
    {
        $elementId = $this->getRequest()->getParam('element_id', md5(microtime()));
        $storeId = $this->getRequest()->getParam('store_id', 0);
        $storeMediaUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

        $content = $this->getLayout()->createBlock('zaproo/adminhtml_news_helper_form_wysiwyg_content', '', array(
            'editor_element_id' => $elementId,
            'store_id' => $storeId,
            'store_media_url' => $storeMediaUrl,
        ));
        $this->getResponse()->setBody($content->toHtml());
    }
}