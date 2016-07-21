<?php

class Ism_News_Block_Post extends Mage_Core_Block_Template
{
    public function getPost()
    {
        $postId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('news/news')->load($postId);

        Mage::dispatchEvent('post_before_render', array('model' => $model));
        
        return $model;
    }

    protected function _prepareLayout()
    {
        $this->_prepareCrumbs();
    }

    protected function _prepareCrumbs()
    {
        $breadcrumbs = $this->getCrumbs();
        if ($breadcrumbs) {
            $breadcrumbs->addCrumb(
                'blog',
                array(
                    'label' => $this->__('Return to News'),
                    'title' => $this->__('Return to News'),
                    'link' => "/news",
                )
            );

            $breadcrumbs->addCrumb(
                'blog_page', array('label' => htmlspecialchars_decode($this->getPost()->getTitle()))
            );
        }

        return $this;
    }

    public function getCrumbs()
    {
        $crumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($crumbs) {
            return $crumbs->addCrumb(
                'home',
                array(
                    'label' => $this->__('Home'),
                    'title' => $this->__('Go to Home Page'),
                    'link' => Mage::getBaseUrl(),
                )
            );
        }

        return false;
    }
}