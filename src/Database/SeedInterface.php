<?php

namespace RSSReader\Database;

/**
 * Seed Interface
 */
interface SeedInterface
{
    /**
     * @return void
     */
    public function exec();
}