<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 4:34 PM
 */
class AlexDev_Zaproo_Helper_Article
    extends Mage_Core_Helper_Abstract
{
    public function getArticlesUrl()
    {
        return Mage::getUrl('zaproo/article/index');
    }

    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('zaproo/article/breadcrumbs');
    }

    public function isRssEnabled()
    {
        return Mage::getStoreConfigFlag('rss/config/active') && Mage::getStoreConfigFlag('zaproo/article/rss');
    }

    public function getRssUrl()
    {
        return Mage::getUrl('zaproo/article/rss');
    }

    public function getFileBaseDir()
    {
        return Mage::getBaseDir('media') . DS . 'article' . DS . 'file';
    }

    public function getFileBaseUrl()
    {
        return Mage::getBaseUrl('media') . 'article' . '/' . 'file';
    }

    public function getAttributeSourceModelByInputType($inputType)
    {
        $inputTypes = $this->getAttributeInputTypes();
        if (!empty($inputTypes[$inputType]['source_model'])) {
            return $inputTypes[$inputType]['source_model'];
        }
        return null;
    }

    public function getAttributeInputTypes($inputType = null)
    {
        $inputTypes = array(
            'multiselect' => array(
                'backend_model' => 'eav/entity_attribute_backend_array'
            ),
            'boolean' => array(
                'source_model' => 'eav/entity_attribute_source_boolean'
            ),
            'file' => array(
                'backend_model' => 'zaproo/article_attribute_backend_file'
            ),
            'image' => array(
                'backend_model' => 'zaproo/article_attribute_backend_image'
            ),
        );

        if (is_null($inputType)) {
            return $inputTypes;
        } else if (isset($inputTypes[$inputType])) {
            return $inputTypes[$inputType];
        }
        return array();
    }

    public function getAttributeBackendModelByInputType($inputType)
    {
        $inputTypes = $this->getAttributeInputTypes();
        if (!empty($inputTypes[$inputType]['backend_model'])) {
            return $inputTypes[$inputType]['backend_model'];
        }
        return null;
    }

    public function articleAttribute($article, $attributeHtml, $attributeName)
    {
        $attribute = Mage::getSingleton('eav/config')->getAttribute(AlexDev_Zaproo_Model_Article::ENTITY, $attributeName);
        if ($attribute && $attribute->getId() && !$attribute->getIsWysiwygEnabled()) {
            if ($attribute->getFrontendInput() == 'textarea') {
                $attributeHtml = nl2br($attributeHtml);
            }
        }
        if ($attribute->getIsWysiwygEnabled()) {
            $attributeHtml = $this->_getTemplateProcessor()->filter($attributeHtml);
        }
        return $attributeHtml;
    }

    protected function _getTemplateProcessor()
    {
        if (null === $this->_templateProcessor) {
            $this->_templateProcessor = Mage::helper('catalog')->getPageTemplateProcessor();
        }
        return $this->_templateProcessor;
    }
}