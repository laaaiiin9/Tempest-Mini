<?php

define('BASE_PATH', __DIR__);

// Core
require BASE_PATH . '/core/Config.php';
require BASE_PATH . '/db/DB.php';
require BASE_PATH . '/core/Migrator.php';

// Load config files
$config_app = require BASE_PATH . '/config/app.php';
$config_db = require BASE_PATH . '/config/database.php';

Config::set('app', $config_app);
Config::set('database', $config_db);

// Initialize DB
DB::initDb();

// CLI args
$command = $argv[1] ?? null;
$args = array_slice($argv, 2);

switch ($command) {
    case 'create:migration':
        require_once BASE_PATH . '/commands/CreateMigrationCommand.php';
        $cmd = new CreateMigrationCommand($args);
        $cmd->handle();
        break;

    case 'delete:migrations':
        require_once BASE_PATH . '/commands/DeleteMigrationsCommand.php';
        $cmd = new DeleteMigrationsCommand($args);
        $cmd->handle();
        break;

    case 'migrate':
        Migrator::migrate();
        break;

    default:
        echo "Unknown command: $command\n";
        break;
}