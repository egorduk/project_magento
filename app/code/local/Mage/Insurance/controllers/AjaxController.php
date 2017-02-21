<?php

class Mage_Insurance_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        $data = $this->getRequest()->getPost();

        $salesQuote = Mage::getModel('sales/quote_address_rate')->load($data['shippingMethodId'], 'code');

        if ($salesQuote) {
            $salesQuoteData = $salesQuote->getData();

            $helper = Mage::helper('Insurance');

            echo $helper->getCurrentCurrencySymbol() . $helper->getInsuranceDeliveryCost($salesQuoteData['price']);
        }
    }
}