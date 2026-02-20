<?php

require BASE_PATH . '/core/Migration.php';

class StudentsTable extends Migration
{
    public function up()
    {
        DB::query("
            CREATE TABLE IF NOT EXISTS students (
                id INT PRIMARY KEY AUTO_INCREMENT,
                first_name VARCHAR(90),
                last_name VARCHAR(90),
                email VARCHAR(90) NOT NULL,
                age INT NOT NULL,
                program VARCHAR(30) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }

    public function down()
    {
        DB::query("DROP TABLE IF EXISTS students");
    }
}
