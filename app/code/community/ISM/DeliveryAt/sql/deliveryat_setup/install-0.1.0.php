<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();

$connection->addColumn(
    $installer->getTable('sales/quote'),
    'delivery_date',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_DATE,
        'comment' => 'Stores delivery date chosen by customer.'
    )
);

$connection->addColumn(
    $installer->getTable('sales/quote'),
    'delivery_time',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 50,
        'unsigned' => false,
        'nullable' => false,
        'default' => null,
        'comment' => 'Stores delivery time.'
    )
);

$connection->addColumn(
    $installer->getTable('sales/order'),
    'delivery_date',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_DATE,
        'comment' => 'Stores delivery date chosen by customer.'
    )
);

$connection->addColumn(
    $installer->getTable('sales/order'),
    'delivery_time',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 50,
        'unsigned' => false,
        'nullable' => false,
        'default' => null,
        'comment' => 'Stores delivery time.'
    )
);

$installer->endSetup();