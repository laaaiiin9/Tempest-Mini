<?php

require BASE_PATH . '/utils/renderer.php';

class Response
{

    public static function view($view, $status = 200, $data = [])
    {
        http_response_code($status);
        $content = renderView($view, $data);
        extract($data);
        require BASE_PATH . '/views/layouts/default.php';
        exit;
    }

    public static function abort($status, $errMsg)
    {
        http_response_code($status);

        $errorView = 'error_pages/' . $status;

        echo renderView($errorView, ['title' => $status, 'errMsg' => $errMsg]);
        exit;
    }
}
