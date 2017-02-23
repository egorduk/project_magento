<?php

class Mage_Insurance_Model_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'delivery insurance';

    public function __construct()
    {
        $this->setCode($this->_code);
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('Insurance')->__('Delivery Insurance');
    }

    public function getIsIncludeInsuranceDelivery()
    {
        return Mage::helper('Insurance')->getIsIncludeInsuranceDelivery();
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        //https://astrio.net/blog/magento-development-add-total-row-checkout/
        //http://blog.magestore.com/magento-checkout-totals/
        parent::collect($address);

        //Mage::log($address->getAddressType());

        $this->_setAmount(0);
        $this->_setBaseAmount(0);

        $items = $this->_getAddressItems($address);

        if (!count($items)) {
            return $this; //this makes only address type shipping to come through
        }

        $quote = $address->getQuote();

        //Mage::helper('Insurance')->unsetIsIncludeInsuranceDelivery();

        $isIncludeInsuranceDelivery = $this->getIsIncludeInsuranceDelivery();
        Mage::log($isIncludeInsuranceDelivery);

        //if ((!$quote->isVirtual() && $address->getAddressType() == 'billing') || $address->getAddressType() == 'shipping' || !$isIncludeInsuranceDelivery) {
        if (!$isIncludeInsuranceDelivery) {
            return $this;
        }


        //if (Excellence_Fee_Model_Fee::canApply($address)) { //your business logic
            $existDeliveryInsurance = $quote->getDeliveryInsurance();
            //$fee = Excellence_Fee_Model_Fee::getFee();
            //$fee = 100;

            $deliveryInsurance = Mage::helper('Insurance')->getInsuranceDeliveryCost($address->getBaseGrandTotal());

            $balance = $deliveryInsurance - $existDeliveryInsurance;
            Mage::log($balance);
            $address->setDeliveryInsurance($balance);
            $address->setBaseDeliveryInsurance($balance);

            $quote->setDeliveryInsurance($balance);

            $address->setGrandTotal($address->getGrandTotal() + $address->getDeliveryInsurance());
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseDeliveryInsurance());

            //Mage::log('Mage_Insurance_Model_Insurance');

        return $this;
       // }
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        //Mage::log('fetch');
        $isIncludeInsuranceDelivery = $this->getIsIncludeInsuranceDelivery();

        // if (($address->getAddressType() == 'billing')) {
        if ($isIncludeInsuranceDelivery && $address->getAddressType() == 'billing') {
            $address->addTotal([
                'code' => $this->getCode(),
                'title' => $this->getLabel(),
                'value' => $address->getDeliveryInsurance(),
            ]);
        }

        return $this;
    }
}