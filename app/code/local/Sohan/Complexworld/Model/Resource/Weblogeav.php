<?php

class Sohan_Complexworld_Model_Resource_Weblogeav extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('complexworld/eavblogpost', 'blogpost_id');
    }
}