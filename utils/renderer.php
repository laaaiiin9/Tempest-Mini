<?php

function renderView($view, ...$data) {
    $viewPath = BASE_PATH . '/views/' . $view . '.php';
    if (!file_exists($viewPath)) {
        echo "View ({$view}) does not exist in the path.";
        return;
    }
    extract(...$data);

    ob_start();
    require BASE_PATH . '/views/' . $view . '.php';
    $content = ob_get_clean();

    return $content;
}