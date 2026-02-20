<?php

require BASE_PATH . '/core/Migration.php';

class UsersTable extends Migration
{
    public function up()
    {
        DB::query("
            CREATE TABLE IF NOT EXISTS users_1 (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }

    public function down()
    {
        DB::query("DROP TABLE IF EXISTS migrations");
    }
}
