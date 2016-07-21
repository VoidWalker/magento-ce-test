<?php

class ISM_DeliveryAt_Block_Checkout_Onepage_Progress_Deliveryat extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('ism/deliveryat/onepage/progress/shipping_method/deliveryat.phtml');
    }

    public function getDeliveryDateProgress()
    {
        $quote = Mage::getSingleton("checkout/cart")->getQuote();
        $deliveryDate['delivery_date'] = $quote->getDeliveryDate();
        if ($quote->getDeliveryTime()) {
            $deliveryDate['delivery_time'] = $quote->getDeliveryTime();
        }

        return $deliveryDate;
    }
}