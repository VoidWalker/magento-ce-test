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
            'content',
            'text',
            array(
                'label' => Mage::helper('news')->__('Content'),
                'name' => 'content',
                'required' => true
            )
        );

        $fieldset->addField(
            'announce',
            'text',
            array(
                'label' => Mage::helper('news')->__('Announce'),
                'name' => 'announce',
                'required' => true
            )
        );

        $fieldset->addField(
            'date',
            'date',
            array(
                'label' => Mage::helper('news')->__('Date'),
                'name' => 'date',
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
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
                'values' => array('-1' => 'Please Select..', '0' => 'No', '1' => 'Yes'),
            )
        );

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'multiselect',
                array(
                    'name' => 'stores[]',
                    'label' => Mage::helper('cms')->__('Store View'),
                    'title' => Mage::helper('cms')->__('Store View'),
                    'required' => true,
                    'values' => Mage::getSingleton('adminhtml/system_store')
                            ->getStoreValuesForForm(false, true),
                )
            );
        }

        if (Mage::getSingleton('adminhtml/session')->getBlogData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif (Mage::registry('blog_data')) {
            $form->setValues(Mage::registry('blog_data')->getData());
        }
        return parent::_prepareForm();
    }
} 