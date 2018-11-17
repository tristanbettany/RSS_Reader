<?php

namespace RSSReader\Database\Migrations;

use RSSReader\Database\Gateways\FeedGateway;
use RSSReader\Database\Migration;
use RSSReader\Database\MigrationInterface;

/**
 * Feeds table creation
 */
final class FeedsTable extends Migration implements MigrationInterface
{
    /** @var string */
    public $name = 'feeds_table';

    /**
     * @return void
     */
    public function exec()
    {
        $this->connection->query('
            CREATE TABLE IF NOT EXISTS `'. FeedGateway::TABLE_NAME .'` (
              `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
              `url` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
              `is_active` tinyint(1) NOT NULL DEFAULT 1,
              `date_added` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
        ');
    }
}