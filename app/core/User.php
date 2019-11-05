<?php
namespace site\app\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use site\app\controllers\UserController;

class User
{
    private static $instance = null;
    public $user = null;

    private function __construct(){
        $this->user = \site\app\models\User::getInstance();
    }

    private function __clone(){}

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getSession($name){
        return @$_SESSION['USER']['info'][$name];
    }

    public function setSession($key, $value){
        $_SESSION['USER']['info'][$key] = $value;
    }

    public function login($login, $password) {

        $userInfo = $this->user->login($login, $password);
        if ($userInfo) {
            $_SESSION['USER']['authorised'] = true;
            $params = ['id','surname','login', 'group_name', 'group_id' ];
            foreach ($params as $param){
                $this->setSession($param, $userInfo[$param]);
            }
            return true;
        }
        return false;
    }

    public function isAuthorised () {
        if(isset($_SESSION['USER']['authorised'])) {
            return $_SESSION['USER']['authorised'];
        }
        return false;
    }
    public function isAdmin(){
        if($this->getSession('group_name') == 'admin'){
            return true;
        }
    }
    public function logout(){
        $_SESSION['USER']['authorised']  = false;
    }
}
