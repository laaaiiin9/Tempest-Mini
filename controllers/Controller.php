<?php

require BASE_PATH . '/utils/renderer.php';

class Controller {

    public function view($view, $data): void {
        global $config;

        $content = renderView($view, $data);
        extract($data);

        require BASE_PATH . '/views/' . $config['default_view'] . '.php';
    }

}