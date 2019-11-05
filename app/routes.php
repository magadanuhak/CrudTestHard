<?php
use Bramus\Router\Router;
use site\app\core\User;
$user = User::getInstance();

$router = new Router();

$router->get('/{module}/{action}/', function($module, $actionString) {
    $action = explode('/', $actionString);
    $this->handleRequest($module,$action[0], @$action[1]);
});

$router->post('/{controller}/{action}/', function($controller, $actionString){
    $actionString = explode('/', $actionString);
    $this->handleRequest($controller,$actionString[0], @$actionString[1]);
});

$router->get('/', function (){
    $this->handleRequest("Main", "index");
});
$router->get('/contact', function (){
    $this->handleRequest("Main", "contact");
});
$router->get('/cart', function (){
    $this->handleRequest("Cart", "index");
});
$router->get('/cart/add/(\d+)', function ($id){
    $this->handleRequest("Cart", "add",  $id);
});
$router->get('/cart/remove/(\d+)', function ($id){
    $this->handleRequest("Cart", "remove", $id);
});

$router->mount('/users', function() use ($router) {

    $router->before('OPTIONS', '/.*', function() {
        if(!User::getInstance()->isAdmin()){
            header('HTTP/1.0 401 Unauthorized');
            echo "Access Not Allowed";
            exit;
        }
    });
    $router->get('/', function (){
            $this->handleRequest("User", "index");
    });

    $router->get('/edit/(\d+)', function ($id){
        $this->handleRequest("User", "edit",  $id);
    });

    $router->post('/add/', function (){
        $this->handleRequest("User", "addUser");
    });

    $router->post('/edit/(\d+)', function($id){
        $this->handleRequest("User", "update" );
    });

    $router->get('/delete/(\d+)', function ($id){
        $this->handleRequest("User", "delete", $id);
    });


});
$router->get('/auth/login', function (){
    $this->handleRequest("Auth", "login");
});
$router->get('/auth/register', function (){
    $this->handleRequest("Auth", "register");
});
$router->post('/auth/register', function (){
    $this->handleRequest("Auth", "register");
});
$router->post('/auth/login', function (){
    $this->handleRequest("Auth", "login");
});
$router->get('/auth/logout', function (){
    $this->handleRequest("Auth", "logout");
});

$router->get('/products', function (){
    $this->handleRequest("Products", "index");
});


$router->set404(function () {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /');
    return \site\app\core\View::render('errors/404');
});
$router->run();
