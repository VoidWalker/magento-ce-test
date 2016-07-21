<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();

$connection->changeColumn(
    $installer->getTable('sales/quote'),
    'delivery_time',
    'delivery_time',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => null
    ));

$connection->changeColumn(
    $installer->getTable('sales/order'),
    'delivery_time',
    'delivery_time',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => null
    ));

$installer->endSetup();