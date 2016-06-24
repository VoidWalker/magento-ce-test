<?php

class Sohan_Complexworld_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $weblog2 = Mage::getModel('complexworld/eavblogpost');
        $weblog2->load(1);
        var_dump($weblog2);
    }

    public function testModelAction()
    {
        $params = $this->getRequest()->getParams();
        $blogpost = Mage::getModel('complexworld/weblogeav');
        echo("Loading the blogpost with an ID of " . $params['id']);
        $blogpost->load($params['id']);
        $data = $blogpost->getData();
        var_dump($data);
    }

    public function createNewPostAction()
    {
        $blogpost = Mage::getModel('complexworld/weblogeav');
        $blogpost->setTitle('Code Post!');
        $blogpost->setPost('This post was created from code!');
        $blogpost->save();
        echo 'post with ID ' . $blogpost->getId() . ' created';
    }

    public function editFirstPostAction()
    {
        $blogpost = Mage::getModel('complexworld/weblogeav');
        $blogpost->load(1);
        $blogpost->setTitle("The First post!");
        $blogpost->save();
        echo 'post edited';
    }

    public function deleteFirstPostAction()
    {
        $blogpost = Mage::getModel('complexworld/weblogeav');
        $blogpost->load(1);
        $blogpost->delete();
        echo 'post removed';
    }

    public function showAllBlogPostsAction()
    {
        $posts = Mage::getModel('complexworld/weblogeav')->getCollection();
        foreach ($posts as $blogpost) {
            echo '<h3>' . $blogpost->getTitle() . '</h3>';
            echo nl2br($blogpost->getPost());
        }
    }
}