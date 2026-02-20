<?php

class App
{

    public Router $router;

    public function run(): void
    {
        $config_app = require BASE_PATH . '/config/app.php';
        $config_db = require BASE_PATH . '/config/database.php';

        require BASE_PATH . '/core/Config.php';

        Config::set('app', $config_app);
        Config::set('database', $config_db);

        if (Config::get('app.env') === 'local') {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
        }

        require BASE_PATH . '/core/Response.php';
        require BASE_PATH . '/core/View.php';

        set_error_handler(function ($severity, $message, $file, $line) {
            throw new ErrorException($message, 0, $severity, $file, $line);
        });

        set_exception_handler(function ($exception) {

            if (Config::get('app.env') === 'local') {
                //Response::abort(500, '<pre>' . $exception . '<pre>');
                Response::abort('error_pages/500', ['error_code' => 500, 'error_msg' => $exception])->layout('errors');
            } else {
                //Response::abort(500, 'Server Error');
                Response::abort('error_pages/500', ['error_code' => 500])->layout('errors');
            }

            exit;
        });

        require BASE_PATH . '/db/DB.php';
        DB::initDb();

        require BASE_PATH . '/core/Router.php';

        $this->router = new Router();

        $router = $this->router;
        require BASE_PATH . '/routes/web.php';
    }

}