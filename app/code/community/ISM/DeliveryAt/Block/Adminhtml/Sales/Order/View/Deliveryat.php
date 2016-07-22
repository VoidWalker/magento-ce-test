<?php

class ISM_DeliveryAt_Block_Adminhtml_Sales_Order_View_Deliveryat extends Mage_Core_Block_Template
{
    public function getOrder()
    {
        if (Mage::registry('current_order')) {
            return Mage::registry('current_order');
        } else {
            return false;
        }
    }
}