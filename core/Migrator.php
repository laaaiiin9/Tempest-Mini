<?php

class Migrator
{
    protected static string $migrationsPath = BASE_PATH . '/db/migrations';

    public static function migrate(): void
    {
        self::ensureMigrationsTable();

        $files = glob(self::$migrationsPath . '/*.php');

        // Sort by filename (timestamps ensure order)
        sort($files);

        foreach ($files as $file) {
            $migrationName = basename($file);

            // Skip already run migrations
            $exists = DB::query(
                "SELECT COUNT(*) as count FROM migrations WHERE migration = :migration",
                ['migration' => $migrationName]
            )->fetchColumn();

            if ($exists)
                continue;

            // Run migration inside a transaction
            DB::beginTransaction();

            try {
                require $file;

                // Class name from file
                $className = str_replace('.php', '', $migrationName);
                $className = self::convertToClassName($className);

                $migration = new $className;
                $migration->up();

                DB::query(
                    "INSERT INTO migrations (migration) VALUES (:migration)",
                    ['migration' => $migrationName]
                );

                DB::commit();

                echo "Migrated: {$migrationName}\n";
            } catch (Exception $e) {
                DB::rollBack();
                echo "Failed: {$migrationName}\n";
                echo $e->getMessage() . "\n";
                exit(1);
            }
        }

        echo "All pending migrations executed.\n";
    }

    protected static function ensureMigrationsTable(): void
    {
        DB::query("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }

    protected static function convertToClassName(string $fileName): string
    {
        // Remove timestamp prefix
        $parts = explode('_', $fileName, 5); // e.g., 2026_02_20_000001_users_table.php
        $namePart = $parts[4] ?? $fileName;

        // Remove .php
        $namePart = str_replace('.php', '', $namePart);

        // Convert snake_case → PascalCase
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $namePart)));
    }
}