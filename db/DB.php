<?php

$db_server = 'mysql';

try {
    $host = $config_db[$db_server]['host'];
    $db_name = $config_db[$db_server]['db_name'];
    $user = $config_db[$db_server]['user'];
    $pass = $config_db[$db_server]['pass'];
    $port = $config_db[$db_server]['port'];

    $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";

    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    //echo 'Database connection initialized.';
} catch (PDOException $pdoErr) {
    Response::abort('500', $pdoErr->getMessage());
    //http_response_code(500);
    //exit;
    // $content = $err_view->renderView('error_pages/404.php');
    // require $content;
    // die("Error on connecting to database: {$pdoErr->getMessage()}");
}
