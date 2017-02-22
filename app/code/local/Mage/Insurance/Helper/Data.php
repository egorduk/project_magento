<?php

class Mage_Insurance_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getCurrentCurrencySymbol()
    {
        return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
    }

    /**
     * @param float $baseTotal
     *
     * @return float
     */
    public function getInsuranceDeliveryCost($baseTotal)
    {
        $deliveryInsurancePercent = Mage::getStoreConfig('checkout/backend/delivery_insurance_percent');
        $deliveryAbsolutePrice = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute_value');
        $deliveryAbsolute = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute');

        if (!$deliveryAbsolute) {
            $deliveryTotal = $baseTotal * ($deliveryInsurancePercent / 100);

            return $baseTotal + $deliveryTotal;
        } else {
            return $baseTotal + $deliveryAbsolutePrice;
        }
    }

    /**
     * @param int $isInclude
     */
    public function setIsIncludeInsuranceDelivery($isInclude = 1)
    {
        Mage::getSingleton('core/session')->setData('isIncludeDeliveryInsurance', $isInclude);
    }

    /**
     * @return int
     */
    public function getIsIncludeInsuranceDelivery()
    {
        return Mage::getSingleton('core/session')->getData('isIncludeDeliveryInsurance');
    }

    public function unsetIsIncludeInsuranceDelivery()
    {
        Mage::getSingleton('core/session')->unsetData('isIncludeDeliveryInsurance');
    }
}