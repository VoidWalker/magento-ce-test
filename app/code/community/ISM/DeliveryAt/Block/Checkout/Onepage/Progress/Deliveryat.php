<?php

class ISM_DeliveryAt_Block_Checkout_Onepage_Progress_Deliveryat extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('ism/deliveryat/progress.phtml');
    }

    public function getDeliveryDateProgress()
    {
        $checkout = Mage::getSingleton('checkout/type_onepage')->getCheckout();
        $deliveryDate = $checkout->getIsmDeliveryDate();

        return $deliveryDate;
    }
}