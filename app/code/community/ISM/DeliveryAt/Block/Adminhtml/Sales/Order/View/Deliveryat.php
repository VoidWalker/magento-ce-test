<?php

class ISM_DeliveryAt_Block_Adminhtml_Sales_Order_View_Deliveryat extends Mage_Core_Block_Template
{

    public function getOrder()
    {
        if (Mage::registry('current_order')) {
            return Mage::registry('current_order');
        }
        if (Mage::registry('order')) {
            return Mage::registry('order');
        }
        Mage::throwException(Mage::helper('deliveryat')->__('Cannot get order instance'));
    }

    public function getDeliveryDateFields()
    {
        $order = $this->getOrder();
        $hlp = Mage::helper('deliveryat');
        $fields[] = array(
            'code' => 'date',
            'label' => $hlp->__('Delivery Date'),
            'value' => $order->getDeliveryDate()
        );
        if ($order->getDeliveryDate() !== null) {
            $fields[] = array(
                'code' => 'time',
                'label' => $hlp->__('Delivery Time'),
                'value' => $order->getDeliveryTime()
            );
        }

        return $fields;
    }
}