<?php

class Ism_News_Adminhtml_PostController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/cms/news');
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('cms/news')
            ->_addBreadcrumb(Mage::helper('news')->__('CMS'), Mage::helper('news')->__('CMS'))
            ->_addBreadcrumb(Mage::helper('news')->__('News'), Mage::helper('news')->__('News'));

        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('CMS'))->_title($this->__('News'));

        $this->_initAction();
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
        $this->_title($this->__('CMS'))->_title($this->__('News'));

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('news/news');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('This block no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Post'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('news_data', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? Mage::helper('news')->__('Edit Post') : Mage::helper('news')->__('New Post'), $id ? Mage::helper('news')->__('Edit Post') : Mage::helper('news')->__('New Post'))
            ->renderLayout();
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
        // the same form is used to create and edit
        $this->_forward('edit');
    }
} 