<?php

class DeliveryInsurance_Insurance_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function getDeliveryInsuranceAction()
    {
        $data = $this->getRequest()->getPost();

        if ($data['shippingMethodId'] && $data['quoteId']) {
            $quoteAddress = Mage::getModel('sales/quote_address_rate')->load($data['shippingMethodId'], 'code');
            $quote = Mage::getModel('sales/quote')->load($data['quoteId']);

            if ($quote && $quoteAddress) {
                $helper = Mage::helper('delivery_insurance');

                $baseTotal = $quote->getBaseSubtotalWithDiscount() + $quoteAddress->getPrice();
                $response = $helper->getCurrentCurrencySymbol() . $helper->getInsuranceDeliveryCost($baseTotal);
                $jsonResponse = Mage::helper('core')->jsonEncode($response);

                $this->getResponse()->setHeader('Content-type', 'application/json');
                $this->getResponse()->setBody($jsonResponse);
            }
        }
    }
}