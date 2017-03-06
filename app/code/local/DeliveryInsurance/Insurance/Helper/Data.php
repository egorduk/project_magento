<?php

class DeliveryInsurance_Insurance_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getCurrentCurrencySymbol()
    {
        return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
    }

    /**
     * @param float|int $baseTotal
     *
     * @return float|int
     */
    public function getInsuranceDeliveryCost($baseTotal)
    {
        $deliveryInsurancePercent = Mage::getStoreConfig('checkout/backend/delivery_insurance_percent');
        $deliveryAbsolutePrice = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute_value');
        $deliveryAbsolute = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute');

        return $deliveryAbsolute ?
            $deliveryAbsolutePrice :
            $baseTotal * ($deliveryInsurancePercent / 100);
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    private function getSession()
    {
        return Mage::getSingleton('core/session');
    }

    /**
     * @param int $isInclude
     */
    public function setIsIncludeInsuranceDelivery($isInclude = 1)
    {
        $this->getSession()->setData('isIncludeDeliveryInsurance', $isInclude);
    }

    /**
     * @return int
     */
    public function getIsIncludeInsuranceDelivery()
    {
        return $this->getSession()->getData('isIncludeDeliveryInsurance');
    }

    public function unsetIsIncludeInsuranceDelivery()
    {
        $this->getSession()->unsetData('isIncludeDeliveryInsurance');
    }
}