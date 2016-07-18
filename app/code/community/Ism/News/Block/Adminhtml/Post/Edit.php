<?php

class Ism_News_Block_Adminhtml_Post_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'news';
        $this->_controller = 'adminhtml_post';

        $this->_updateButton('save', 'label', Mage::helper('news')->__('Save Post'));
        $this->_updateButton('delete', 'label', Mage::helper('news')->__('Delete Post'));

        $this->_addButton(
            'saveandcontinue',
            array(
                'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class' => 'save',
            ),
            -100
        );

        $this->_formScripts[]
            = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('news_data') && Mage::registry('news_data')->getId()) {
            return Mage::helper('news')->__(
                "Edit Post '%s'", $this->escapeHtml(Mage::registry('news_data')->getTitle())
            );
        } else {
            return Mage::helper('news')->__('Add Post');
        }
    }
} 