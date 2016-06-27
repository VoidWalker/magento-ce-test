<?php

class Ism_News_PostController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $params = $this->getRequest()->getParams();
        $newsPost = Mage::getModel('news/news');
        echo("Loading the blogpost with an ID of " . $params['id']);
        $newsPost->load($params['id']);
        $data = $newsPost->getData();
        var_dump($data);
    }

    public function viewAllAction()
    {
        $posts = Mage::getModel('news/news')->getCollection();
        foreach ($posts as $post) {
            echo '<h3>' . $post->getTitle() . '</h3>';
            echo nl2br($post->getContent());
            echo nl2br($post->getAnnounce());
            echo $post->getDate();
        }
    }

    public function addAction()
    {
        $post = Mage::getModel('news/news');
        $post->setTitle('News Title from code');
        $post->setContent('News Content from code');
        $post->setAnnounce('News Announce from code');
        $post->setDate(time());
        $post->save();
        echo 'Post with ID: ' . $post->getNewsId() . ' created!';
    }

    public function editAction()
    {
        $params = $this->getRequest()->getParams();
        $post = Mage::getModel('news/news');
        $post->load($params['id']);
        $post->setTitle('News Title from code');
        $post->setContent('News Content from code');
        $post->setAnnounce('News Announce from code');
        $post->setDate(time());
        $post->save();
        echo 'Post with ID: ' . $post->getNewsId() . ' created!';
    }

    public function deleteAction()
    {
        $params = $this->getRequest()->getParams();
        $post = Mage::getModel('news/news');
        $post->load($params['id']);
        $post->delete();
        echo "News removed";
    }

    public function testCollectionAction()
    {
        $collection_of_news = Mage::getModel('news/news')->getCollection();
        var_dump($collection_of_news->getFirstItem()->getData());
    }
}