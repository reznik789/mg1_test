<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 3:20 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Attribute_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'attribute_id';
        $this->_controller = 'adminhtml_article_attribute';
        $this->_blockGroup = 'zaproo';

        parent::__construct();
        $this->_addButton(
            'save_and_edit_button',
            array(
                'label' => Mage::helper('zaproo')->__('Save and Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class' => 'save'
            ),
            100
        );
        $this->_updateButton('save', 'label', Mage::helper('zaproo')->__('Save Article Attribute'));
        $this->_updateButton('save', 'onclick', 'saveAttribute()');

        if (!Mage::registry('entity_attribute')->getIsUserDefined()) {
            $this->_removeButton('delete');
        } else {
            $this->_updateButton('delete', 'label', Mage::helper('zaproo')->__('Delete Article Attribute'));
        }
    }

    public function getHeaderText()
    {
        if (Mage::registry('entity_attribute')->getId()) {
            $frontendLabel = Mage::registry('entity_attribute')->getFrontendLabel();
            if (is_array($frontendLabel)) {
                $frontendLabel = $frontendLabel[0];
            }
            return Mage::helper('zaproo')->__('Edit Article Attribute "%s"', $this->htmlEscape($frontendLabel));
        } else {
            return Mage::helper('zaproo')->__('New Article Attribute');
        }
    }

    public function getValidationUrl()
    {
        return $this->getUrl('*/*/validate', array('_current' => true));
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/' . $this->_controller . '/save', array('_current' => true, 'back' => null));
    }
}