<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('sales/order'), 'delivery_insurance', [
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'length' => '12,4',
    'nullable' => true,
    'default' => null,
    'comment' => 'Delivery insurance price',
]);

$installer->getConnection()->addColumn($installer->getTable('sales/order'), 'base_delivery_insurance', [
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'length' => '12,4',
    'nullable' => true,
    'default' => null,
    'comment' => 'Base delivery insurance price',
]);

$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'), 'delivery_insurance', [
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'length' => '12,4',
    'nullable' => true,
    'default' => null,
    'comment' => 'Delivery insurance price',
]);

$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'), 'base_delivery_insurance', [
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'length' => '12,4',
    'nullable' => true,
    'default' => null,
    'comment' => 'Base delivery insurance price',
]);

$installer->endSetup();