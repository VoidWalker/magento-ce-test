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
//             Checkout Progress
//            $blockClass = Mage::getConfig()->getBlockClassName('checkout/onepage_progress');
//            if ($blockClass == get_class($block)) {
//                $checkout = Mage::getSingleton('checkout/type_onepage')->getCheckout();
//                if ($checkout->getStepData('shipping_method', 'complete')
//                    && !$checkout->getStepData('payment', 'complete')
//                ) {
//                    $pos = strripos($html, '</dd>');
//                    $insert = Mage::app()->getLayout()->createBlock('deliveryat/checkout_onepage_progress_shipping_method_deliveryat')->toHtml();
//                    $html = substr_replace($html, $insert, $pos - 1, 0);
//                }
//            }
        }
    }

    public function onOnepageSaveShippingMethod($observer)
    {
        $data = $observer->getRequest()->getPost('deliveryat');
        $quote = $observer->getQuote();

        $quote->setDeliveryDate($data['delivery_date']);
        if (isset($data['delivery_time_id'])) {
            $data['delivery_time'] = Mage::helper('deliveryat')->getIntervalById($data['delivery_time_id']);
            $quote->setDeliveryTime($data['delivery_time']);
        }
    }
}