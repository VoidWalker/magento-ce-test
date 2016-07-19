<?php

class ISM_DeliveryAt_Model_Observer
{
    public function onCoreBlockAbstractToHtmlAfter($observer)
    {
        $storeId = Mage::app()->getStore()->getId();
        if ($isEnaled = Mage::getStoreConfig('deliveryat/general/enabled', $storeId)) {
            $block = $observer->getBlock();
            $transport = $observer->getTransport();
            $html = $transport->getHtml();
            //Shipping Method Step
            $blockClass = Mage::getConfig()->getBlockClassName('checkout/onepage_shipping_method_available');
            if ($blockClass == get_class($block)) {
                $html .= Mage::app()->getLayout()->createBlock('deliveryat/checkout_onepage_shipping_method_deliveryat')->toHtml();
            }
            $transport->setHtml($html);
        }
    }

    public function onSalesQuoteSaveAfter($observer)
    {
        if ($data = Mage::app()->getRequest()->getPost('deliveryat')) {
            $checkout = Mage::getSingleton('checkout/type_onepage')->getCheckout();
            $checkout->setIsmDeliveryDate($data);
        }
    }
}