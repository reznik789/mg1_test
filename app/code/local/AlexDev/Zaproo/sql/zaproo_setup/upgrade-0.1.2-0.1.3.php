<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/6/16
 * Time: 11:23 AM
 *
 */

$installer = Mage::getResourceModel('catalog/setup', 'default_setup');
/**
* @var $installer Mage_Catalog_Model_Resource_Setup
 */

$installer->startSetup();

$installer->updateAttribute(
    'catalog_product',
    'attribute_installed',
    'backend_model',
    'eav/entity_attribute_backend_array'
);

$installer->endSetup();


