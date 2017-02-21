<?php

class Mage_Insurance_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getCurrentCurrencySymbol()
    {
        return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
    }

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
}