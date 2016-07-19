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

            // Checkout Progress
            $blockClass = Mage::getConfig()->getBlockClassName('checkout/onepage_progress');
            if ($blockClass == get_class($block)) {
                $checkout = Mage::getSingleton('checkout/type_onepage')->getCheckout();
                if ($checkout->getStepData('shipping_method', 'complete')
                    && !$checkout->getStepData('payment', 'complete')) {
                    $insert = Mage::app()->getLayout()->createBlock('deliveryat/checkout_onepage_progress_deliveryat')->toHtml();
                    $html .= $insert;
                }
            }

            $transport->setHtml($html);
        }
    }

    public function onSalesQuoteSaveAfter($observer)
    {
        if ($data = Mage::app()->getRequest()->getPost('deliveryat')) {
            $checkout = Mage::getSingleton('checkout/type_onepage')->getCheckout();
            if (isset($data['delivery_time_id'])) {
                $data['delivery_time'] = Mage::helper('deliveryat')->getIntervalById($data['delivery_time_id']);
            }
            $checkout->setIsmDeliveryDate($data);
        }
    }
}