<?php

require_once __DIR__ . '/Command.php';

class DeleteMigrationsCommand extends Command
{
    public function handle(): void
    {
        $directory = BASE_PATH . '/db/migrations';

        if (!is_dir($directory)) {
            echo "No migrations folder found at {$directory}\n";
            return;
        }

        echo "Are you sure you want to delete ALL migrations? Type 'y' to confirm: ";
        $handle = fopen("php://stdin", "r");
        $line = trim(fgets($handle));

        if ($line !== 'y') {
            echo "Aborted.\n";
            return;
        }

        $this->deleteFolder($directory);
        echo "Migrations folder deleted successfully.\n";
    }

    private function deleteFolder(string $folder): void
    {
        $items = scandir($folder);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..')
                continue;

            $path = $folder . DIRECTORY_SEPARATOR . $item;

            if (is_dir($path)) {
                $this->deleteFolder($path);
            } else {
                unlink($path);
            }
        }

        rmdir($folder);
    }
}