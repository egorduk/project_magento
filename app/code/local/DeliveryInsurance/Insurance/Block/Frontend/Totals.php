<?php

class DeliveryInsurance_Insurance_Block_Frontend_Totals extends Mage_Sales_Block_Order_Totals
{
    public function initTotals()
    {
        $order = $this->getOrder();
        $amount = $order->getDeliveryInsurance();

        if ($amount != 0) {
            $total = new Varien_Object();
            $total->setCode('delivery_insurance');
            $total->setValue($amount);
            $total->setBaseValue($order->getBaseDeliveryInsurance());
            $total->setLabel(Mage::helper('delivery_insurance')->__('Delivery Insurance'));

            $parent = $this->getParentBlock();
            $parent->addTotal($total, 'subtotal');
        }
    }

    public function getOrder()
    {
        if (!$this->hasData('order')) {
            $order = $this->getParentBlock()->getOrder();
            $this->setData('order', $order);
        }

        return $this->getData('order');
    }
}