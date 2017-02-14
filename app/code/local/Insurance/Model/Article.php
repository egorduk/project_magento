<?php

class Insurance_Model_Article extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();

        $this->_init('blog/article');
    }
}