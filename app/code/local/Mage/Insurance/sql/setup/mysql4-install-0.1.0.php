<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('sales/order')}
ADD COLUMN `delivery_insurance` decimal(12,4) default NULL,
ADD COLUMN `base_delivery_insurance` decimal(12,4) default NULL;
ALTER TABLE {$this->getTable('sales/quote')}
ADD COLUMN `delivery_insurance` decimal(12,4) default NULL,
ADD COLUMN `base_delivery_insurance` decimal(12,4) default NULL;
");

$installer->endSetup();