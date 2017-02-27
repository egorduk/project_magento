<?php

class DeliveryInsurance_Insurance_Model_Observer
{
    public function saveOrderAfter()
    {
        Mage::helper('delivery_insurance')->unsetIsIncludeInsuranceDelivery();
    }

    public function saveShippingMethod()
    {
        $postData = Mage::app()->getFrontController()->getRequest()->getPost();

        $helper = Mage::helper('delivery_insurance');

        isset($postData['deliveryInsurance']) ?
            $helper->setIsIncludeInsuranceDelivery() :
            $helper->unsetIsIncludeInsuranceDelivery();

        return $this;
    }
}