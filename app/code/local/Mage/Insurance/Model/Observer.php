<?php
class Mage_Insurance_Model_Observer
{
    /**
     * This function is called just before $quote object get stored to database.
     * Here, from POST data, we capture our custom field and put it in the quote object
     * @param Varien_Event_Observer $observer
     */
    public function saveQuoteBefore($observer)
    {
        /* @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        if (!$quote) {
            return;
        }

        $post = Mage::app()->getFrontController()->getRequest()->getPost();
        $request = Mage::app()->getFrontController()->getRequest();
        //$quote->setBaseGrandTotal(777);

        //var_dump($quote);
        //var_dump($post);die;

        /*if (isset($post['custom']['ssn'])) {
            $var = $post['custom']['ssn'];
            $quote->setSsn($var);
        }*/

        Mage::log($quote->getBaseGrandTotal());
        Mage::log($request->getParam('deliveryInsurance'));

        $deliveryInsurance = $post['deliveryInsurance'];

        if ($deliveryInsurance) {
            $deliveryInsurancePercent = Mage::getStoreConfig('checkout/backend/delivery_insurance_percent');
            $deliveryAbsolutePrice = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute_value');
            $deliveryAbsolute = Mage::getStoreConfig('checkout/backend/delivery_insurance_absolute');

            if (!$deliveryAbsolute) {
                $deliveryTotal = $quote->getBaseGrandTotal() * ($deliveryInsurancePercent / 100);
                $baseGrandTotal = $quote->getBaseGrandTotal() + $deliveryTotal;
                $quote->setBaseGrandTotal($baseGrandTotal);

                Mage::log($baseGrandTotal);
            }
        }
       // Mage::log($post['deliveryInsurance']);
        //Mage::log(print_r($post));
    }

    public function saveQuoteItemBefore($observer)
    {
        Mage::log('saveQuoteItemBefore');
    }

    /**
     *
     * This function is called after order gets saved to database.
     * Here we transfer our custom fields from quote table to order table i.e sales_order_custom
     * @param $evt
     */
    public function saveOrderAfter($evt)
    {
        //var_dump('saveOrderAfter');die;
        /* @var Mage_Sales_Model_Order $order */
        $order = $evt->getOrder();
        $quote = $evt->getQuote();
        $order->setBaseGrandTotal(777);
        //Mage::log($order->getBaseGrandTotal());die;

      /*  if ($quote->getSsn()){
            $var = $quote->getSsn();

            if (!empty($var)) {
                $model = Mage::getModel('custom/custom_order');
                $model->deleteByOrder($order->getId(),'ssn');
                $model->setOrderId($order->getId());
                $model->setKey('ssn');
                $model->setValue($var);
                $order->setSsn($var);
                $model->save();
            }
        }*/
    }

    public function saveOrderBefore($obs)
    {
        $event = $obs->getEvent();
        $order = $event->getOrder();
        Mage::log($order->getBaseGrandTotal());die;
        return $this;
        //$request = Mage::app()->getFrontController()->getRequest();
        //$percentorder = $request->getParam('percentorder');
        //$commission = $request->getParam('commission');
    }

    public function saveShippingMethod($observer)
    {
        //$event = $obs->getEvent();
        //$quote = $observer->getEvent()->getQuote();
        //$quote = $evt->getQuote();
        //var_dump($quote->getBaseGrandTotal());

        Mage::helper('Insurance')->setIsIncludeInsuranceDelivery();
        Mage::log('saveShippingMethod');
        //Mage::log(Mage::getSingleton('core/session')->getData('isIncludeDeliveryInsurance'));
        return $this;
    }
}