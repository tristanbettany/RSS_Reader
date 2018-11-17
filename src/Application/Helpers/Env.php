<?php

namespace RSSReader\Application\Helpers;

/**
 * App Env Class
 */
final class Env
{
    /** @var array */
    private $envVars;

    /**
     * Constructor
     *
     * @param array $envVars
     */
    public function __construct(array $envVars = [])
    {
        $this->envVars = $envVars;

        $this->setupEnv();
    }

    /**
     * Set up env vars
     */
    public function setupEnv()
    {
        foreach($this->envVars as $key => $var) {
            putenv($key.'='.$var);
        }
    }
}