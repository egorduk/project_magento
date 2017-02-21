<?php

class Magentotutorial_Helloworld_Model_Resource_Blogpost extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('helloworld/blogpost', 'blogpost_id');
    }
}