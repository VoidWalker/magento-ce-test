<?php

class Ism_News_Block_Manage_Post_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('news_grid');
        $this->setDefaultSort('sort_order');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('news/news')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'news_id',
            array(
                'header' => Mage::helper('news')->__('ID'),
                'align' => 'right',
                'width' => '50px',
                'index' => 'news_id',
            )
        );

        $this->addColumn(
            'title',
            array(
                'header' => Mage::helper('news')->__('Title'),
                'align' => 'left',
                'index' => 'title',
            )
        );

        $this->addColumn(
            'announce',
            array(
                'header' => Mage::helper('news')->__('Announce'),
                'align' => 'left',
                'index' => 'announce',
            )
        );

        $this->addColumn(
            'is_published',
            array(
                'header' => Mage::helper('news')->__('Publish status'),
                'align' => 'left',
                'index' => 'is_published',
            )
        );

        $this->addColumn(
            'action',
            array(
                'header' => Mage::helper('news')->__('Action'),
                'width' => '100px',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('news')->__('Delete'),
                        'url' => array('base' => '*/*/delete'),
                        'field' => 'id',
                        'confirm' => $this->__('Are you sure?')
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('news_id');
        $this->getMassactionBlock()->setFormFieldName('news');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('news')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('news')->__('Are you sure?'),
            )
        );

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}