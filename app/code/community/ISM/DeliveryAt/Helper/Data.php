<?php

/**
 * Class ISM_DeliveryAt_Helper_Data
 */
class ISM_DeliveryAt_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_intervals = array(
        1 => 'Morning (8:00-12:00)',
        2 => 'Midday (12:00-16:00)',
        3 => 'Evening (16:00-20:00)'
    );

    public function getIntervalById($id)
    {
        return $this->_intervals[$id];
    }

}