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
    'is_visible_on_front',
    1
);
$installer->endSetup();


