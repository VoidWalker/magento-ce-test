<?php

class Ism_News_Manage_PostController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/cms/news');
    }

    public function indexAction()
    {
        $this->_title($this->__('Posts'))->_title($this->__('News'));
        $this->loadLayout()->_setActiveMenu('cms/news');
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
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('news/manage_post_edit'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Post does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('news/news');

            $model
                ->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
                if (isset($data['date']) && $data['date']) {
                    $dateFrom = Mage::app()->getLocale()->date($data['date'], $format);
                    $model->setDate(Mage::getModel('core/date')->gmtDate(null, $dateFrom->getTimestamp()));
                } else {
                    $model->setDate(Mage::getModel('core/date')->gmtDate());
                }

                Mage::dispatchEvent('post_before_save_action', array('model' => $model));
                
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('news')->__('Post was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));

                    return;
                }
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Unable to find post to save'));
        $this->_redirect('*/*/');
    }

    public function newAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('news/news')->load($id);

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('news_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('cms/news');
        $this->_title($this->__('Add new post'))->_title($this->__('News'));

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->_addContent($this->getLayout()->createBlock('news/manage_post_edit'));

        $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        $this->renderLayout();
    }
} 