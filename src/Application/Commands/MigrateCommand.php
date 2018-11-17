<?php

namespace RSSReader\Application\Commands;

/**
 * Migrate Command class
 */
final class MigrateCommand extends Command implements CommandInterface
{
    /** @var string */
    public $name = 'migrate';
    /** @var string */
    public $description = 'Migration Command';

    /**
     * @param array $arguments
     *
     * @return mixed
     */
    public function exec(array $arguments)
    {
        var_dump('migrate', $arguments);
    }
}