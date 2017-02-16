<?php

class Insurance_Model_Mysql_Article extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('blog/article', 'article_id');
    }
}