<?php

class Mage_Insurance_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        $data = $this->getRequest()->getPost();
        var_dump($data);
    }
}