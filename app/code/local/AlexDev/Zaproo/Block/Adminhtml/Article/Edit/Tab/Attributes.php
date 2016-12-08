<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:10 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Edit_Tab_Attributes
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setDataObject(Mage::registry('current_article'));
        $fieldset = $form->addFieldset('info',
            array(
                'legend' => Mage::helper('zaproo')->__('Article Information'),
                'class' => 'fieldset-wide',
            )
        );
        $attributes = $this->getAttributes();
        foreach ($attributes as $attribute) {
            $attribute->setEntity(Mage::getResourceModel('zaproo/article'));
        }
        $this->_setFieldset($attributes, $fieldset, array());
        $formValues = Mage::registry('current_article')->getData();
        $form->addValues($formValues);
        $form->setFieldNameSuffix('article');
        $this->setForm($form);
    }

    protected function _prepareLayout()
    {
        Varien_Data_Form::setElementRenderer(
            $this->getLayout()->createBlock('adminhtml/widget_form_renderer_element')
        );
        Varien_Data_Form::setFieldsetRenderer(
            $this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')
        );
        Varien_Data_Form::setFieldsetElementRenderer(
            $this->getLayout()->createBlock('zaproo/adminhtml_news_renderer_fieldset_element')
        );
    }

    protected function _getAdditionalElementTypes()
    {
        return array(
            'file' => Mage::getConfig()->getBlockClassName('zaproo/adminhtml_article_helper_file'),
            'image' => Mage::getConfig()->getBlockClassName('zaproo/adminhtml_article_helper_image'),
            'textarea' => Mage::getConfig()->getBlockClassName('adminhtml/catalog_helper_form_wysiwyg')
        );
    }

    public function getArticle()
    {
        return Mage::registry('current_article');
    }
}