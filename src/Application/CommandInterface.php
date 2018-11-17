<?php

namespace RSSReader\Application;

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