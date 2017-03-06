<?php

class DeliveryInsurance_Insurance_Model_Totals_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $helper;

    public function __construct()
    {
        $this->setCode('delivery_insurance');
        $this->helper = Mage::helper('delivery_insurance');
    }

    public function getIsIncludeInsuranceDelivery()
    {
        return $this->helper->getIsIncludeInsuranceDelivery();
    }

    public function getInsuranceDeliveryCost($grandTotal)
    {
        return $this->helper->getInsuranceDeliveryCost($grandTotal);
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $isIncludeInsuranceDelivery = $this->getIsIncludeInsuranceDelivery();

        if ($address->getAddressType() == 'billing' || !$isIncludeInsuranceDelivery) {
            return $this;
        }

        $grandTotal = Mage::getModel('checkout/session')->getQuote()->getGrandTotal();

        $deliveryInsurance = $this->getInsuranceDeliveryCost($grandTotal);

        $address->setDeliveryInsurance($deliveryInsurance);
        $address->setBaseDeliveryInsurance($deliveryInsurance);
        $address->setBaseGrandTotal($address->getBaseGrandTotal() + $deliveryInsurance);
        $address->setGrandTotal($address->getGrandTotal() + $deliveryInsurance);

        return $this;
    }


    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $isIncludeInsuranceDelivery = $this->getIsIncludeInsuranceDelivery();

        if ($address->getAddressType() != 'billing' && $isIncludeInsuranceDelivery) {
            $amount = $address->getDeliveryInsurance();

            if ($amount != 0) {
                $address->addTotal([
                    'code' => $this->getCode(),
                    'title' => $this->helper->__('Delivery Insurance'),
                    'value' => $amount,
                ]);
            }
        }

        return $this;
    }
}