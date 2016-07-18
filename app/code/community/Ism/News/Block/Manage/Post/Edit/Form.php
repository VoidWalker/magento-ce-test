<?php

class Ism_News_Block_Manage_Post_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl(
                    '*/*/save', array('id' => $this->getRequest()->getParam('id'))
                ),
                'method' => 'post',
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'post_form', array('legend' => Mage::helper('news')->__('Post Information'))
        );

        $fieldset->addField(
            'title',
            'text',
            array(
                'label' => Mage::helper('news')->__('Title'),
                'name' => 'title',
                'required' => true
            )
        );

        $fieldset->addField(
            'is_published',
            'select',
            array(
                'label' => Mage::helper('news')->__('Published'),
                'name' => 'is_published',
                'required' => true,
                'values' => array(
                    array(
                        'value' => 0,
                        'label' => Mage::helper('blog')->__('Disabled'),
                    ),
                    array(
                        'value' => 1,
                        'label' => Mage::helper('blog')->__('Enabled'),
                    )
                ),
            )
        );

        /*
        try {
            $config = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
            $config->setData(
                Mage::helper('news')->recursiveReplace(
                    '/news_admin/',
                    '/' . (string)Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName') . '/',
                    $config->getData()
                )
            );
        } catch (Exception $ex) {
            $config = null;
        }
        */

        $fieldset->addField(
            'announce',
            'editor',
            array(
                'label' => Mage::helper('news')->__('Announce'),
                'name' => 'announce',
                'style' => 'width:700px; height:100px;'
            )
        );

        $fieldset->addField(
            'content',
            'editor',
            array(
                'name' => 'content',
                'label' => Mage::helper('news')->__('Content'),
                'title' => Mage::helper('news')->__('Content'),
                'style' => 'width:700px; height:500px;'
            )
        );

        $outputFormat = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);

        $fieldset->addField(
            'date',
            'date',
            array(
                'name' => 'date',
                'label' => Mage::helper('news')->__('Date'),
                'title' => Mage::helper('news')->__('Date'),
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => $outputFormat,
                'time'   => true,
                'style' => 'width:200px;'
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getNewsData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getNewsData());
            Mage::getSingleton('adminhtml/session')->setNewsData(null);
        } elseif (Mage::registry('news_data')) {
            $form->setValues(Mage::registry('news_data')->getData());
        }

        return parent::_prepareForm();
    }
} 