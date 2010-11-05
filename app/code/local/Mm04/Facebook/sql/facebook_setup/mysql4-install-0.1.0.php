<?php

$installer = $this;
/* @var $installer Mage_Customer_Model_Entity_Setup */

$installer->startSetup();

$installer->run("ALTER TABLE {$this->getTable('customer_entity')}
    ADD COLUMN `facebook_id` VARCHAR(50) AFTER `email`,
    ADD INDEX IDX_FB_AUTH(`facebook_id`, `website_id`)");

$installer->addAttribute('customer', 'facebook_id', array(
    'type'          => 'static',
    'label'         => 'Facebook ID',
    'sort_order'    => 61,
));

$installer->endSetup();
$installer->installEntities();
?>