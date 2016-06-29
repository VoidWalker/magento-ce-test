<?php

class Ism_News_Block_News extends Mage_Core_Block_Template
{
    public function getNews()
    {
        return Mage::getModel('news/news')->getCollection();
    }
}