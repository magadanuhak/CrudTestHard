<?php

namespace site\app\core;

use Dotenv\Dotenv;

class APP
{
    private static $instance = null;

    public static function getInstance () {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function handleRequest($model, $action, $params = []) {
        $modelName = ucfirst($model);
        $actionName = ucfirst($action);
        $controller = "site\app\controllers\\{$modelName}Controller";
        $method = "action{$actionName}";

        $objController = new $controller;

        ob_start();
        $objController->$method($params);
        $viewContent = ob_get_contents();
        ob_end_clean();
        View::loadLayout('default', $viewContent);
    }

    public function run () {
        Dotenv::create('../')->load();

        require_once '../app/routes.php';
    }
}
