<?php

class Insurance_Adminhtml_ArticleController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('blog/article')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Articles Manager'), Mage::helper('adminhtml')->__('Articles Manager'));

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->renderLayout();
    }
}