<?php
/**
 * Created by PhpStorm.
 * User: dev30
 * Date: 12/5/16
 * Time: 2:04 PM
 *
 *@var $this Mage_Core_Model_Resource_Setup
 */

$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE {$installer->getTable('zaproo/test')} 
        ADD `type` VARCHAR (255) NOT NULL DEFAULT '',
        ADD `editable` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
        ADD `comment` TEXT,
        ADD `updated_at` DATETIME;
");

$installer->endSetup();