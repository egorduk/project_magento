<?php

class DeliveryInsurance_Insurance_Model_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $code = 'delivery_insurance';

    public function __construct()
    {
        $this->setCode($this->code);
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('delivery_insurance')->__('Delivery Insurance');
    }

    public function getIsIncludeInsuranceDelivery()
    {
        return Mage::helper('delivery_insurance')->getIsIncludeInsuranceDelivery();
    }

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        //https://astrio.net/blog/magento-development-add-total-row-checkout/
        //http://blog.magestore.com/magento-checkout-totals/
        //parent::collect($address);

        //var_dump($address);

        //$this->_setAmount(0);
        //$this->_setBaseAmount(0);

        //$items = $this->_getAddressItems($address);

        //if (!count($items)) {
        //    return $this; //this makes only address type shipping to come through
        //}

        $quote = $address->getQuote();

        //Mage::helper('Insurance')->unsetIsIncludeInsuranceDelivery();

        $isIncludeInsuranceDelivery = $this->getIsIncludeInsuranceDelivery();

        //if (($quote->isVirtual() && $address->getAddressType() == 'billing') /*|| $address->getAddressType() == 'shipping' */|| !$isIncludeInsuranceDelivery) {
        //if (!$isIncludeInsuranceDelivery) {
            //return $this;
       // }

        if ($isIncludeInsuranceDelivery) {
            //foreach ($this->_getAddressItems($address) as $item) {
                //Mage::log('item - ' . $item['baseGrandTotal']);
                //Mage::log('item - ' . $item->geGrandTotal());
            //}
           // var_dump($quote);
            $deliveryInsurance = Mage::helper('delivery_insurance')->getInsuranceDeliveryCost($quote->getBaseGrandTotal());
            Mage::log('collect $deliveryInsurance - ' . $deliveryInsurance);

            $address->setDeliveryInsurance($deliveryInsurance);
            $address->setBaseDeliveryInsurance($deliveryInsurance);

            $quote->setDeliveryInsurance($deliveryInsurance);
            $quote->setBaseDeliveryInsurance($deliveryInsurance);

            //Mage::log($address->getId());
            //$adr = Mage::getModel('sales/quote_address')->load($address->getId());
            Mage::log($address->getGrandTotal());
            Mage::log($address->getBaseGrandTotal());
            //Mage::log('session checkout ' . Mage::getModel('checkout/session')->getQuote()->getGrandTotal());
            Mage::log($quote->getBaseGrandTotal());
            Mage::log($quote->getGrandTotal());
            //Mage::log($address->getAddressType());

            //$address->setGrandTotal($address->getGrandTotal() + $deliveryInsurance);
            //$address->setBaseGrandTotal($address->getBaseGrandTotal() + $deliveryInsurance);
        }

        //Mage::log('collect - ' . $isIncludeInsuranceDelivery);

        //$existDeliveryInsurance = $quote->getDeliveryInsurance();

        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        //Mage::log('fetch');
        $isIncludeInsuranceDelivery = $this->getIsIncludeInsuranceDelivery();

        // if (($address->getAddressType() == 'billing')) {
        if ($isIncludeInsuranceDelivery /*&& $address->getAddressType() == 'billing'*/) {
            $quote = $address->getQuote();
            //Mage::log(var_dump($quote));
            //Mage::log(var_dump($address));

            $address->addTotal([
                'code' => $this->getCode(),
                'title' => $this->getLabel(),
                'value' => $quote->getDeliveryInsurance(),
                //'value' => $address->getDeliveryInsurance(),
            ]);
        }

        return $this;
    }
}