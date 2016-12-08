<?php

/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/8/16
 * Time: 2:41 PM
 */
class AlexDev_Zaproo_Block_Adminhtml_Article_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'zaproo';
        $this->_controller = 'adminhtml_article';
        $this->_updateButton('save', 'label', Mage::helper('zaproo')->__('Save Article'));
        $this->_updateButton('delete', 'label', Mage::helper('zaproo')->__('Delete Article'));
        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('zaproo')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('current_article') && Mage::registry('current_article')->getId()) {
            return Mage::helper('zaproo')->__("Edit Article '%s'", $this->escapeHtml(Mage::registry('current_article')->getTitle()));
        } else {
            return Mage::helper('zaproo')->__('Add Article');
        }
    }
}