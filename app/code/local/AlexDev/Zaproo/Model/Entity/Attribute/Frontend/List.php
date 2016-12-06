<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/6/16
 * Time: 1:31 PM
 */

class AlexDev_Zaproo_Model_Entity_Attribute_Frontend_List
    extends Mage_Eav_Model_Entity_Attribute_Frontend_Abstract
{
    public function getValue(Varien_Object $object)
    {
        if($this->getConfigField('input') == 'multiselect') {
            $value = $object->getData($this->getAttribute()->getAttributeCode());

            $value = $this->getOption($value);

            if (is_array($value)) {
                $output = "<ul><li>". implode('</li><li>', $value) . "</li></ul>";
                return $output;
            } else {
                return $value;
            }
        } else {
            return parent::getValue($object);
        }
    }
}