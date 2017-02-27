<?php

class Mage_Insurance_Block_Adminhtml_Totals_Invoice extends Mage_Adminhtml_Block_Sales_Order_Totals
{
    protected function _initTotals()
    {
        parent::_initTotals();

        $order = $this->getSource();

        $amount = $order->getDeliveryInsurance();

        if ($amount) {
            $this->addTotalBefore(new Varien_Object([
                'code'      => 'delivery_insurance',
                'value'     => $amount,
                'base_value'=> $amount,
                'label'     => $this->helper('Insurance')->__('Delivery Insurance'),
            ], ['shipping', 'tax']));
        }

        return $this;
    }
}