<?php

class DeliveryInsurance_Insurance_Model_Observer
{
    protected $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('delivery_insurance');
    }

    public function saveOrderAfter()
    {
        $this->helper->unsetIsIncludeInsuranceDelivery();
    }

    public function saveShippingMethod()
    {
        $postData = Mage::app()->getFrontController()->getRequest()->getPost();

        isset($postData['deliveryInsurance']) ?
            $this->helper->setIsIncludeInsuranceDelivery() :
            $this->helper->unsetIsIncludeInsuranceDelivery();

        return $this;
    }
}