<?php

class Mage_Insurance_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        $data = $this->getRequest()->getPost();

        $quoteAddress = Mage::getModel('sales/quote_address_rate')->load($data['shippingMethodId'], 'code');
        $quote = Mage::getModel('sales/quote')->load($data['quoteId']);

        if ($quote && $quoteAddress) {
            $helper = Mage::helper('Insurance');

            /* @var Mage_Sales_Model_Quote $quote */

            $baseTotal = $quote->getBaseSubtotalWithDiscount() + $quoteAddress->getPrice();

            echo $helper->getCurrentCurrencySymbol() . $helper->getInsuranceDeliveryCost($baseTotal);
        }
    }
}