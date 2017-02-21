<?php

class Mage_Insurance_Model_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'fee';

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);

        $items = $this->_getAddressItems($address);

        if (!count($items)) {
            return $this; //this makes only address type shipping to come through
        }

        $quote = $address->getQuote();

        //if (Excellence_Fee_Model_Fee::canApply($address)) { //your business logic
            $existAmount = $quote->getFeeAmount();
            //$fee = Excellence_Fee_Model_Fee::getFee();
            //$fee = 100;

            $deliveryInsurance = Mage::helper('Insurance')->getInsuranceDeliveryCost($address->getBaseGrandTotal());

            $balance = $deliveryInsurance - $existAmount;
            $address->setFeeAmount($balance);
            $address->setBaseFeeAmount($balance);

            $quote->setFeeAmount($balance);

            $address->setGrandTotal($address->getGrandTotal() + $address->getFeeAmount());
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseFeeAmount());

            Mage::log('Mage_Insurance_Model_Insurance');
       // }
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amt = $address->getFeeAmount();
        $address->addTotal([
            'code' => $this->getCode(),
            //'title' => Mage::helper('fee')->__('Fee'),
            'title' => __('Insurance delivery'),
            'value' => $amt,
        ]);

        return $this;
    }
}