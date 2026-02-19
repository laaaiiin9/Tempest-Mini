<?php

require BASE_PATH . '/utils/renderer.php';

class Response
{
    protected $view;
    protected $data = [];
    protected $layout = 'default';
    protected $status = 200;
    protected $rendered = false;

    public static function view($view, $data = [], $status = 200)
    {
        $instance = new self;

        $instance->view = $view;
        $instance->data = $data;
        $instance->status = $status;

        return $instance;
    }

    public function layout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    protected function render()
    {
        if ($this->rendered) {
            return;
        }

        $this->rendered = true;

        http_response_code($this->status);

        $content = renderView($this->view, $this->data);
        extract($this->data);

        require BASE_PATH . Config::get('app.layouts_path') . "/{$this->layout}.php";
    }

    public function __destruct()
    {
        $this->render();
    }

    public static function abort($status, $errMsg)
    {
        http_response_code($status);

        $errorView = 'error_pages/' . $status;

        echo renderView($errorView, [
            'title' => $status,
            'errMsg' => $errMsg
        ]);

        exit;
    }
}
