<?php

class Ism_News_Manage_PostController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Posts'))->_title($this->__('News'));
        $this->loadLayout()->_setActiveMenu('cms/news');
        $this->_addBreadcrumb(
            Mage::helper('adminhtml')->__('News Manager 1'), Mage::helper('adminhtml')->__('News Manager 2')
        );
        //$this->_addContent($this->getLayout()->createBlock('news/manage_post'));
        $this->renderLayout();
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('news/news');

                $model
                    ->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Post ' . $this->getRequest()->getParam('id') . ' was successfully deleted')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('news/news')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('news_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('cms/news');
            $this->_title($this->__('Edit post'))->_title($this->__('News'));

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Blog Manager'), Mage::helper('adminhtml')->__('BlogManager')
            );
            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Category Manager'), Mage::helper('adminhtml')->__('Category Manager')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('news/manage_post_edit'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Post does not exist'));
            $this->_redirect('*/*/');
        }
    }
} 