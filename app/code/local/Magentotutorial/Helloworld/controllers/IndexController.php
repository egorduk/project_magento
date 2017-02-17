<?php

class Magentotutorial_Helloworld_IndexController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
        //echo 'Hello World';
        $this->loadLayout();
        $this->renderLayout();
        //http://devdocs.magento.com/guides/m1x/magefordev/mage-for-dev-4.html
    }

    public function goodbyeAction() {
        //echo 'Goodbye World!';
        $this->loadLayout();
        $this->renderLayout();
    }

    public function testModelAction() {
        //echo 'Setup!';
        //$blogpost = Mage::getModel('helloworld/blogpost');
        //var_dump($blogpost->getCollection());
        //echo get_class($blogpost);

        $params = $this->getRequest()->getParams();
        $blogpost = Mage::getModel('helloworld/blogpost');
        //var_dump($blogpost);
        echo("Loading the blogpost with an ID of ".$params['id']);
        $blogpost->load($params['id']);
        $data = $blogpost->getData();
        var_dump($data);
    }
}