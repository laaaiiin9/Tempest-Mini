<?php

class View
{
    protected static array $sections = [];
    protected static string $layout = '';
    protected static string $currentSection = '';

    public static function render($view, array $data = [])
    {
        self::$sections = [];
        self::$layout = '';

        $viewPath = BASE_PATH . '/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("View [$view] not found.");
        }
        
        extract($data);

        ob_start();
        require $viewPath;
        
        if (self::$layout) {
            ob_end_clean();
        } else {
            echo ob_get_clean();
        }

        if (self::$layout) {
            echo self::renderLayout($data);
            return;
        }

        echo '';
    }

    public static function abort($view, array $data = [], $status = 500)
    {
        self::$sections = [];
        self::$layout = '';

        http_response_code($status);

        $viewPath = BASE_PATH . '/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception("View [$view] not found.");
        }
        
        extract($data);

        ob_start();
        require $viewPath;

        if (self::$layout) {
            ob_end_clean();
        } else {
            echo ob_get_clean();
        }

        if (self::$layout) {
            echo self::renderLayout($data);
            return;
        }

        echo '';
    }

    public static function extend($layout)
    {
        self::$layout = $layout;
    }

    public static function section($name)
    {
        self::$currentSection = $name;
        ob_start();
    }

    public static function endSection()
    {
        self::$sections[self::$currentSection] = ob_get_clean();
        self::$currentSection = '';
    }

    public static function yield($name)
    {
        echo self::$sections[$name] ?? '';
    }

    protected static function renderLayout(array $data = [])
    {
        $layoutPath = BASE_PATH . '/views/' . self::$layout . '.php';

        if (!file_exists($layoutPath)) {
            throw new Exception("Layout not found.");
        }

        extract($data);

        ob_start();
        require $layoutPath;
        return ob_get_clean();
    }
}