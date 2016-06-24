<?php
echo 'Running This Upgrade: ' . get_class($this) . "\n <br /> \n";
/** @var Sohan_Weblog_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()
    ->newTable($installer->getTable('weblog/blogpost'))
    ->addColumn('blogpost_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT)
    ->addColumn('post', Varien_Db_Ddl_Table::TYPE_TEXT)
    ->addColumn('date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'default' => null
    ))
    ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
        'nullable' => false
    ));
$installer->getConnection()->createTable($table);

/*
$installer->run("
    CREATE TABLE `{$installer->getTable('weblog/blogpost')}` (
      `blogpost_id` int(11) NOT NULL auto_increment,
      `title` text,
      `post` text,
      `date` datetime default NULL,
      `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
      PRIMARY KEY  (`blogpost_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    INSERT INTO `{$installer->getTable('weblog/blogpost')}` VALUES (1,'My New Title','This is a blog post','2009-07-01 00:00:00','2009-07-02 23:12:30');
");*/

$installer->endSetup();