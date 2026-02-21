<?php

class App
{

    public Router $router;

    public function run(): void
    {
        $this->initSession();
        $this->loadCoreClasses();
        $this->loadConfig();
        $this->configureErrorDisplay();
        $this->registerErrorHandlers();
        $this->initDatabase();
        $this->initRouter();
    }

    private function initSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    private function loadCoreClasses(): void
    {
        require BASE_PATH . '/core/Config.php';
        require BASE_PATH . '/core/View.php';
        require BASE_PATH . '/core/Validator.php';
        require BASE_PATH . '/core/RateLimiter.php';
    }

    private function loadConfig(): void
    {
        $configs = [
            'app' => require BASE_PATH . '/config/app.php',
            'database' => require BASE_PATH . '/config/database.php',
        ];

        foreach ($configs as $key => $value) {
            Config::set($key, $value);
        }
    }

    private function configureErrorDisplay(): void
    {
        if ($this->isLocalEnvironment()) {
            ini_set('display_errors', '1');
            error_reporting(E_ALL);
            return;
        }

        ini_set('display_errors', '0');
    }

    private function registerErrorHandlers(): void
    {
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new ErrorException($message, 0, $severity, $file, $line);
        });

        set_exception_handler(function (Throwable $exception) {
            $data = ['error_code' => 500];

            if ($this->isLocalEnvironment()) {
                $data['error_msg'] = $exception;
            }

            View::abort('errors/500', $data, 500);
            exit;
        });
    }

    private function initDatabase(): void
    {
        require BASE_PATH . '/db/DB.php';
        DB::initDb();
    }

    private function initRouter(): void
    {
        require BASE_PATH . '/core/RouteDefinition.php';
        require BASE_PATH . '/core/Router.php';

        $this->router = new Router();
        $router = $this->router;

        require BASE_PATH . '/routes/web.php';
    }

    private function isLocalEnvironment(): bool
    {
        return Config::get('app.env') === 'local';
    }

}
