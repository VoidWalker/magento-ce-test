<?php

class Ism_News_Block_Manage_Post extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'news';
        $this->_controller = 'manage_post';
        $this->_headerText = Mage::helper('news')->__('News Manager Ism_News_Block_Manage_Post');
        parent::__construct();
    }
} 