<?php

require BASE_PATH . '/utils/renderer.php';

class Response
{

    public static function view($view, $status = 200, $data = [])
    {
        global $config_app;

        http_response_code($status);
        echo renderView($view, $data);
        exit;
    }

    public static function abort($status, $errMsg)
    {
        global $config_app;
        http_response_code($status);

        $errorView = 'error_pages/' . $status;

        echo renderView($errorView, ['title' => $status, 'errMsg' => $errMsg]);
        exit;
    }
}
