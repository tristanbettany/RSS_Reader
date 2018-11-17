<?php

namespace RSSReader\Application\Commands;

use RSSReader\Application\Helpers\Config;

/**
 * Migrate Command class
 */
final class MigrateCommand extends Command implements CommandInterface
{
    /** @var string */
    public $name = 'migrate';
    /** @var string */
    public $description = 'Migration Command';

    /** @var array */
    private $migrations = [];

    /**
     * @param array $arguments
     *
     * @return mixed
     */
    public function exec(array $arguments)
    {
        $this->loadMigrations();
        $this->resolveMigration($arguments);
        echo "\n";
    }

    /**
     * Load Migrations
     */
    private function loadMigrations()
    {
        $migrations = Config::get('migrations');
        foreach ($migrations as $migration) {
            $this->migrations[] = new $migration;
        }
    }

    /**
     * Resolve the migration
     *
     * @param array $arguments
     */
    private function resolveMigration(array $arguments)
    {
        if (empty($arguments) === true) {
            $this->executeAllMIgrations();
        } else {
            if ($arguments[0] === 'all') {
                $this->executeAllMIgrations();
            } else {
                $this->executeSingleMigration($arguments[0]);
            }
        }
    }

    /**
     * Execute all migrations
     */
    private function executeAllMIgrations()
    {
        foreach($this->migrations as $migration) {
            $migration->exec();
            echo "Executed Migration : " . $migration->name . "\n";
        }
    }

    /**
     * Execute a specific migration
     *
     * @param string $migrationName
     */
    private function executeSingleMigration(string $migrationName)
    {
        foreach($this->migrations as $migration) {
            if ($migration->name === $migrationName) {
                $migration->exec();
                echo "Executed Migration : " . $migration->name . "\n";
            }
        }
    }
}