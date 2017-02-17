<?php

class Insurance_Model_Mysql_Article_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();

        $this->_init('blog/article');
    }
}