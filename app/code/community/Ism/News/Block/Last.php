<?php

class Ism_News_Block_Last extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        $this->setTemplate('ism_news/widget_post.phtml');

        return $this->setData('news_widget_recent_count', $this->getPostsCount())->renderView();
    }

    public function getLast()
    {
        $posts_count = $this->getPostsCount();
        /** @var Ism_News_Model_Resource_News_Collection $collection */
        $collection = Mage::getModel('news/news')->getCollection()
            ->setOrder('date', 'desc')
            ->setPageSize($posts_count);

        return $collection;
    }
}