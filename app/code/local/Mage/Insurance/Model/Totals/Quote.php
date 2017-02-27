<?php

class Mage_Insurance_Model_Totals_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function __construct()
    {
        $this->setCode('delivery_insurance');
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $quote = $address->getQuote();

        if (!$quote->isVirtual() && $address->getAddressType() == 'billing') {
            return $this;
        }

        $helper = Mage::helper('Insurance');

        $deliveryInsurance = $helper->getInsuranceDeliveryCost(/*$address->getBaseGrandTotal()*/500);

        //Mage::log('$deliveryInsurance - ' . $deliveryInsurance);

        $address->setDeliveryInsurance($deliveryInsurance);
        $address->setBaseDeliveryInsurance($deliveryInsurance);

        //$quote->setDeliveryInsurance($deliveryInsurance);
        //$quote->setBaseDeliveryInsurance($deliveryInsurance);

        $address->setBaseGrandTotal($address->getBaseGrandTotal() + $deliveryInsurance);
        $address->setGrandTotal($address->getGrandTotal() + $deliveryInsurance);

/*        Mage::log('getBaseGrandTotal - ' . $address->getBaseGrandTotal());
        Mage::log('getGrandTotal - ' . $address->getGrandTotal());
        Mage::log('getBaseGrandTotal - ' . $quote->getBaseGrandTotal());
        Mage::log('getGrandTotal - ' . $quote->getGrandTotal());*/

        return $this;
    }


    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        //Mage::log('$amount - ' . $amount);
        if (($address->getAddressType() == 'billing')) {
            $amount = $address->getDeliveryInsurance();

            if ($amount != 0) {
                $address->addTotal([
                    'code' => $this->getCode(),
                    'title' => 'DI',
                    'value' => $amount,
                ]);
            }
        }

        return $this;
    }
}