<?php

namespace RSSReader\Application\Commands;

use RSSReader\Application\Command;
use RSSReader\Application\CommandInterface;
use RSSReader\Application\Helpers\Config;

/**
 * Seed Command class
 */
final class SeedCommand extends Command implements CommandInterface
{
    /** @var string */
    public $name = 'seed';
    /** @var string */
    public $description = '{all|seed_name} Seed Command';

    /** @var array */
    private $seeds = [];

    /**
     * @param array $arguments
     *
     * @return mixed
     */
    public function exec(array $arguments)
    {
        $this->loadSeeds();
        $this->resolveSeed($arguments);
        echo "\n";
    }

    /**
     * Load Seeds
     */
    private function loadSeeds()
    {
        $seeds = Config::get('seeds');
        foreach ($seeds as $seed) {
            $this->seeds[] = new $seed;
        }
    }

    /**
     * Resolve the seed
     *
     * @param array $arguments
     */
    private function resolveSeed(array $arguments)
    {
        if (empty($arguments) === true) {
            $this->executeAllSeeds();
        } else {
            if ($arguments[0] === 'all') {
                $this->executeAllSeeds();
            } else {
                $this->executeSingleSeed($arguments[0]);
            }
        }
    }

    /**
     * Execute all seeds
     */
    private function executeAllSeeds()
    {
        foreach($this->seeds as $seed) {
            $seed->exec();
            echo "Executed Seed : " . $seed->name . "\n";
        }
    }

    /**
     * Execute a specific seed
     *
     * @param string $seedName
     */
    private function executeSingleSeed(string $seedName)
    {
        foreach($this->seeds as $seed) {
            if ($seed->name === $seedName) {
                $seed->exec();
                echo "Executed Seed : " . $seed->name . "\n";
            }
        }
    }
}