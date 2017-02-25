<?php

class Mage_Insurance_Model_Insurance1 extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function __construct()
    {
        $this->setCode('lesson23_discount');
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $quote = $address->getQuote();

        if (!$quote->isVirtual() && $address->getAddressType() == 'billing') {
            return $this;
        }

        //$helper = Mage::helper('Insurance');

        $deliveryInsurancePercent = Mage::getStoreConfig('checkout/backend/delivery_insurance_percent');
        $deliveryAbsolutePrice = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute_value');
        $deliveryAbsolute = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute');

        if ($deliveryAbsolute) {
            $deliveryInsurance = $deliveryAbsolutePrice;
        } else {
            $deliveryInsurance = $quote->getBaseGrandTotal() * ($deliveryInsurancePercent / 100);
        }

        //$deliveryInsurance = $helper->getInsuranceDeliveryCost($address->getBaseGrandTotal());
        //$deliveryInsurance = 15;
       // Mage::log('$deliveryInsurance - ' . $deliveryInsurancePercent);
        //Mage::log('$deliveryInsurance - ' . $deliveryAbsolutePrice);

        $address->setDeliveryInsurance($deliveryInsurance);
        $address->setBaseDeliveryInsurance($deliveryInsurance);

        $address->setBaseGrandTotal($address->getBaseGrandTotal() + $deliveryInsurance);
        $address->setGrandTotal($address->getGrandTotal() + $deliveryInsurance);

        //Mage::log('getBaseGrandTotal - ' . $address->getBaseGrandTotal());
        //Mage::log('getGrandTotal - ' . $address->getGrandTotal());

        return $this;
    }


    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $address->getDeliveryInsurance();
        //$amount = 10;
        //$title = Mage::helper('lesson23')->__('Lesson23 Discount');

        if ($amount != 0) {
            $address->addTotal([
                'code' => $this->getCode(),
                'title' => 'DI',
                'value' => $amount,
            ]);
        }

        return $this;
    }
}