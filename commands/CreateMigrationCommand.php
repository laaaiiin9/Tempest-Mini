<?php

require_once __DIR__ . '/Command.php';

class CreateMigrationCommand extends Command
{
    public function handle(): void
    {
        $migrationName = $this->args[0] ?? null;

        if (!$migrationName) {
            echo "Usage: php create:migration migration_name\n";
            exit(1);
        }

        $directory = BASE_PATH . '/db/migrations';
        if (!is_dir($directory))
            mkdir($directory, 0777, true);

        // Count existing migrations for the same day to create unique number
        $existingFiles = glob("{$directory}/" . date('Y_m_d') . "*_{$migrationName}.php");
        $counter = count($existingFiles) + 1;

        $timestamp = date('Y_m_d') . '_' . str_pad($counter, 6, '0', STR_PAD_LEFT);
        $fileName = "{$timestamp}_{$migrationName}.php";
        $filePath = $directory . '/' . $fileName;

        $className = str_replace(' ', '', ucwords(str_replace('_', ' ', $migrationName)));

        $content = <<<PHP
        <?php

        require BASE_PATH . '/core/Migration.php';

        class {$className} extends Migration
        {
            public function up()
            {
                // TODO: implement migration
            }

            public function down()
            {
                // TODO: rollback migration
            }
        }

        PHP;

        file_put_contents($filePath, $content);

        echo "Migration created: {$filePath}\n";
    }
}