<?php

/**
 * Created by PhpStorm.
 * User: a.sohan
 * Date: 27.06.16
 * Time: 15:12
 */
class Ism_News_Model_Resource_News extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('news/news', 'news_id');
    }
}