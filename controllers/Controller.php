<?php

//require BASE_PATH . '/utils/renderer.php';

class Controller {

    protected $db;

    public function __construct($db) {
        //global $db;
        $this->db = $db;
    }

    // public function view($view, $data): void {
    //     $content = renderView($view, $data);
    //     extract($data);

    //     require BASE_PATH . '/views/' . $config_app['default_view'] . '.php';
    // }

}   