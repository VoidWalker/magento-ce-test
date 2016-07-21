<?php

class ISM_News_Block_News extends Mage_Core_Block_Template
{
    public function getNews()
    {

        $collection = Mage::getModel('news/news')->getCollection();

        Mage::dispatchEvent('news_before_render', array('collection' => $collection));

        return $collection;
    }
}