<?php

/**
 * Class ISM_DeliveryAt_Helper_Data
 */
class ISM_DeliveryAt_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected static $_dictionary = array(
        'dd' => '%d',
        'd' => '%j',
        'MM' => '%m',
        'M' => '%n',
        'yyyy' => '%Y',
        'yy' => '%y',
    );


    protected $_intervals = array(
        0 => 'Morning (8:00-12:00)',
        1 => 'Midday (12:00-16:00)',
        2 => 'Evening (16:00-20:00)'
    );

    public function getIntervalById($id)
    {
        return $this->_intervals[$id];
    }

    public function getIntervals()
    {
        return $this->_intervals;
    }

    public function getPhpFormat($storeId = 0)
    {
        return str_replace('%', '', $this->_convert(Mage::getStoreConfig('deliveryat/date_field/format', $storeId)));
    }

    private function _convert($value)
    {
        foreach (self::$_dictionary as $search => $replace) {
            $value = preg_replace('/(^|[^%])' . $search . '/', '$1' . $replace, $value);
        }

        return $value;
    }

    public function isEnabled()
    {
        $storeId = Mage::app()->getStore()->getId();

        return Mage::getStoreConfig('deliveryat/general/enabled', $storeId);
    }

}