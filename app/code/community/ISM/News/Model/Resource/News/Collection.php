<?php

/**
 * Created by PhpStorm.
 * User: a.sohan
 * Date: 27.06.16
 * Time: 16:08
 */
class Ism_News_Model_Resource_News_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('news/news');
    }
}