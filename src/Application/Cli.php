<?php

namespace RSSReader\Application;

use RSSReader\Application\Helpers\Config;

/**
 * Cli Class
 */
final class Cli
{
    /** @var array */
    private $config;
    /** @var array */
    private $arguments;

    /**
     * Cli constructor.
     *
     * @param array $config
     * @param array $arguments
     */
    public function __construct(
        array $config,
        array $arguments
    ) {
        $this->config = $config;
        $this->arguments = $arguments;

        $this->setConfig();
        $this->boot();
    }

    /**
     * Setup the config for the app
     */
    private function setConfig()
    {
        new Config($this->config);
    }

    /**
     * Bootstrap the app
     */
    private function boot()
    {
        $commandObjects = [];

        $commands = $this->config['commands'];
        foreach ($commands as $command) {
            $commandObjects[] = new $command;
        }

        if (empty($this->arguments[1]) === true) {
            $this->printHelp($commandObjects);
        } else {
            if ($this->arguments[1] === 'help') {
                $this->printHelp($commandObjects);
            } else {
                foreach($commandObjects as $command) {
                    if ($command->name === $this->arguments[1]) {
                        $arguments = $this->arguments;
                        array_shift($arguments);
                        array_shift($arguments);
                        $command->exec($arguments);
                    }
                }
            }
        }
    }

    /**
     * @param array $commandObjects
     */
    private function printHelp(array $commandObjects)
    {
        echo "CLI help\n";
        echo "---------\n";
        echo "\n";
        foreach($commandObjects as $command) {
            echo $command->name . "  >  " . $command->description . "\n";
        }
        echo "\n";
    }
}