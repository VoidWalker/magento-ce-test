<?php

class ISM_DeliveryAt_Block_Checkout_Onepage_Shipping_Method_Deliveryat extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('ism/deliveryat/deliveryat.phtml');
    }

    public function getFormElements()
    {
        $hlp = Mage::helper('deliveryat');
        $storeId = $this->getCurrentStore();

        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('deliveryat', array());
        $values = array();

        $afterElementHtml = '<div type="anchor" id="anchor_delivery_date"></div>';
        $afterElementHtml .= '<div style="padding: 4px;"></div>';

        $fieldset->addField(
            'delivery_date',
            'date',
            array(
                'label' => $hlp->__('Delivery Date'),
                'title' => $hlp->__('Delivery Date'),
                'name' => 'deliveryat[delivery_date]',
                'required' => 0,
                'readonly' => 1,
                'onclick' => 'deliverydate_trig(delivery_date_trig)',
                'after_element_html' => $afterElementHtml,
                'image' => $this->getSkinUrl('images/ism/deliveryat/grid-cal.gif'),
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM)
            ));

        if (Mage::getStoreConfig('deliveryat/time_field/enabled', $storeId)) {
            $afterElementHtml = '<div type="anchor" id="anchor_delivery_time"></div>';
            $afterElementHtml .= '<div style="padding: 4px;"></div>';
            $options_ = array(
                'label' => $hlp->__('Delivery Time Interval'),
                'title' => $hlp->__('Delivery Time Interval'),
                'name' => 'deliveryat[delivery_time_id]',
                'required' => Mage::getStoreConfig('deliveryat/time_field/required', $storeId),
                'values' => array(
                    array(
                        'value' => 0,
                        'label' => $hlp->__('Morning (8:00-12:00)'),
                    ),
                    array(
                        'value' => 1,
                        'label' => $hlp->__('Midday (12:00-16:00)'),
                    ),
                    array(
                        'value' => 2,
                        'label' => $hlp->__('Evening (16:00-20:00)'),
                    )
                ),
                'after_element_html' => $afterElementHtml,
            );
//            if (!isset($values['delivery_date'])) {
//                $options_['disabled'] = 'disabled';
//            }
            $fieldset->addField('delivery_time', 'select', $options_);
        }
        $form->setValues($values);

        return $form->getElements();
    }

    protected function _toHtml()
    {
        if (!$this->getFormElements()) {
            return '';
        }
        $html = parent::_toHtml();
        $html = str_replace('</label>', '</label><div style="clear: both;"></div>', $html);

        return $html;
    }

    public function getCurrentStore()
    {
        return Mage::app()->getStore()->getId();
    }
}