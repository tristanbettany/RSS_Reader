<?php

namespace RSSReader\Database;

/**
 * Migration Interface
 */
interface MigrationInterface
{
    /**
     * @return void
     */
    public function exec();
}