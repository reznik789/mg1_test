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
    DROP TABLE IF EXISTS {$installer->getTable('zaproo/test')};
    CREATE TABLE  {$installer->getTable('zaproo/test')} (
      `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     `name` VARCHAR (255) NOT NULL DEFAULT '',
     `created_at` DATETIME
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();