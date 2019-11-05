<?php
namespace site\app\controllers;

use site\app\core\User;
use site\app\core\View;
use site\app\services\Mail;
use site\app\Utils;
use Valitron\Validator;

class AuthController
{
    public function actionLogin (){
        if(
            (!isset($_POST['username']) || !isset($_POST['password']))
        ){
            return View::render('auth/login');
        }

        if(!User::getInstance()->login($_POST['username'], $_POST['password'])) {
            return View::render('auth/login_error');

        } else {
            return View::render('main/index');
        }
    }
    public function actionRegister(){

        if((!isset($_POST['username']) || !isset($_POST['email']))){
            return View::render('auth/register');
        }
        $validator = $this->validate($_POST, ['username', 'email', 'password'], ['password', 'password_confirmation']);

        if(empty($validator)){
            if(\site\app\models\User::getInstance()->register($_POST['username'], $_POST['email'], $_POST['name'], $_POST['password'])) {
                $this->sendActivationMail($_POST['email'], md5($_POST['username']));
                return View::render('auth/register_success', $_POST);
            } else{
                return View::render('auth/register_error');
            }
        } else{
            View::render('auth/register');
            Utils::showValidationErrors($validator);
        }

    }

    public function actionFinish($hash){
        $status = \site\app\models\User::getInstance()->isActivated($hash);
        if($status['activated'] == 'N' && $status['status'] == 'N'){
            if(empty($_POST['password']) && empty($_POST['password_confirmation'])) {
                View::render('user/password');
            } else {
                if($_POST['password'] == $_POST['password_confirmation']) {
                    if (\site\app\models\User::getInstance()->finishRegistration( md5($_POST["password"]), $hash)) {
                        View::render('main/index');
                    }
                } else{
                    View::render('user/activation_error');
                }
            }
        }

        if($status['activated'] == 'N' ) {
            \site\app\models\User::getInstance()->activateAccount($hash);
        } else {
            return false;
        }
    }

    public function sendActivationMail($email, $hash){
        $mail = new Mail();
        $subject = "Please activate your account";
        $htmlMessage = "
            <h1>You are successful registered </h1>
            <p>To activate your account follow this link: <a href='http://my.md/auth/finish/{$hash}'>Activate</a> </p>
        ";
        $mail->send($subject, $htmlMessage, $email);
    }

    public function actionLogout(){
       unset($_SESSION['USER']);
       return View::render('main/index');
    }

    public function validate($data, $required = [], $equals = []){
        $v = new Validator($data);
        $v->rules([
            'email' => [
                ['email']
            ],
            'lengthMin' =>[
                'email' => 4,
                'username' => 4,
                'name'  => 3,
                'password' => 4,
                'password_confirmation' => 4
            ],
            'lengthMax' =>[
                'email' => 200,
                'username' => 100,
                'name'  => 200,
                'password' => 100,
                'password_confirmation' => 100
            ],
            'required' => $required,
            'equals' => [$equals],
        ]);
        $v->validate();
        return $v->errors();
    }

}
