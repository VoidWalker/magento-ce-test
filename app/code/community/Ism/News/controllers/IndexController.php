<?php

class Ism_News_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $posts = Mage::getModel('news/news')->getCollection();
//        foreach ($posts as $post) {
//            echo '<h3>' . $post->getTitle() . '</h3>';
//            echo nl2br($post->getContent());
//            echo nl2br($post->getAnnounce());
//            echo $post->getDate();
//        }
        $this->renderLayout();
    }
}