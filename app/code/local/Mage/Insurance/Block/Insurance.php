<?php

class Mage_Insurance_Block_Insurance extends Mage_Core_Block_Template
{
    public function getCustomVars()
    {
        //$model = Mage::getModel('custom/custom_order');
        //return $model->getByOrder($this->getOrder()->getId());
        var_dump(Mage::registry('current_order'));
    }

    public function getOrder()
    {
        //return Mage::registry('current_order');
    }
}