<?php

$installer = $this;

$installer->startSetup();

$installer->run("DROP TABLE IF EXISTS {$this->getTable('blog_articles')};
CREATE TABLE {$this->getTable('blog_articles')} (
 `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(150) NOT NULL,
 `slug` varchar(150) NOT NULL,
 `content` text,
 `meta_keywords` varchar(255) NOT NULL DEFAULT '',
 `meta_description` varchar(160) NOT NULL DEFAULT '',
 `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$installer->endSetup();