<?php
/** @var Ism_News_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('news/news'))
    ->addColumn('news_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
    ), 'News ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ), 'News Title')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'News Body')
    ->addColumn('announce', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'News announce')
    ->addColumn('date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(), 'Mews Publish Date')
    ->addColumn('is_published', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'default' => 0
    ), 'News status')
    ->setComment('Ism news/news entity table');
$installer->getConnection()->createTable($table);
$installer->run("INSERT INTO `{$installer->getTable('news/news')}` VALUES (1,'My New Title','This is a news post','News Announce','2009-07-02 23:12:30', 0);");
$installer->run("INSERT INTO `{$installer->getTable('news/news')}` VALUES (2,'My New Title2','This is a news post2','News Announce2','2009-08-02 23:12:30', 0);");
$installer->endSetup();