<?php

class ISM_DeliveryAt_Block_Checkout_Onepage_Shipping_Method_Deliveryat extends Mage_Core_Block_Template
{
    public function isTimeEnabled()
    {
        $storeId = $this->getCurrentStore();

        return Mage::getStoreConfig('deliveryat/time_field/enabled', $storeId);
    }

    public function getCurrentStore()
    {
        return Mage::app()->getStore()->getId();
    }
}