<?php

namespace RSSReader\Application\Commands;

/**
 * Command Interface
 */
interface CommandInterface
{
    /**
     * @param array $arguments
     *
     * @return mixed
     */
    public function exec(array $arguments);
}