<?php

namespace site\app\controllers;

use site\app\core\View;
use site\app\models\User;
use site\app\Utils;
use Valitron\Validator;
use site\app\services\Mail;

class UserController
{
    public function actionIndex(){

        $dates = @explode( '-', $_GET['filter']['people.birthday']);
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $query = "";
        if(isset($_GET['filter'])){
            foreach(array_filter($_GET['filter']) as $field => $value){
                switch ($field){
                    case 'people.birthday' :
                        if(!empty($value)){
                            $query.=" AND 
                                {$field} 
                            BETWEEN 
                                STR_TO_DATE('{$dates[0]}', '%d.%m.%Y') AND
                                STR_TO_DATE('{$dates[1]}', '%d.%m.%Y')";
                        }
                        break;
                    default : $query.= " AND {$field} like '{$value}%' ";
                        break;
                }
            }
        }
        $data = [
            "users" => User::getInstance()->getList($query,10, $page),
            "user_groups" => User::getInstance()->getAllGroups()
        ];
        View::render('user/list', $data);
        $current = (isset($_GET['page'])) ? $_GET['page'] : 1 ;
        echo \site\app\Utils::makePaginator('users', 'id', 10, $current, " WHERE deleted = 'N' ");

    }
    public function actionProfile(){
        $user = User::getInstance()->getUser(\site\app\core\User::getInstance()->getSession('id'));
        View::render('user/user_profile', $user);

    }

    public function actionEdit($id){
        if(isset($_POST['login'])){
            if(empty($this->validate($_POST, [], ['login', 'email', 'name'])) && User::getInstance()->userExist($_POST['login'])){
                User::getInstance()->update($id, $_POST);
                View::render('user/success_updated');
            }
        } else {
            $data = [
                'user' => User::getInstance()->getUser($id),
                'user_groups' => User::getInstance()->getAllGroups()
            ];
            View::render('user/edit', $data);
        }
    }

    public function actionAdd($data){
        $validator = $this->validate($_POST, [], ['login', 'email', 'name']);
        if(empty($validator)) {
            $this->addUser();
        } else{
            $data = [
                'user_groups' => User::getInstance()->getAllGroups(),
                'inputs' => $_POST
            ];
            Utils::showValidationErrors($validator);
            View::render('user/add', $data );
        }
    }

    public function addUser(){

        $userExist = User::getInstance()->userExist($_POST['login']);
        if(
            !$userExist &&
            User::getInstance()->addUser($_POST, \site\app\core\User::getInstance()->getSession('id'))
        ) {
            $mail = new Mail();
            $message = '
                <h1>
                    Your acount was been created please set a password follow this link 
                    <a href="http://my.md/auth/finish/'.md5($_POST['login']).'">Set a password</a>
                </h1>
            ';
            $mail->send('Chose a password for yout account', $message, $_POST['email']);
            View::render('user/success_added');
        } else{
            View::render('user/add', ['user_groups' => User::getInstance()->getAllGroups()]);
            echo ($userExist) ? 'Login exist please select other' : '';

        }
    }

    public function actionDelete($data){
        $user = User::getInstance();
        if(\site\app\core\User::getInstance()->getSession('group_id') > $user->getUser($data)['group_id']) {
            $user->delete($data);
        }
        header('Location: /users');
    }

    public function validate($data, $equals = '', $required = []){
        $v = new Validator($data);
        $v->rules([
            'email' => [
                ['email']
            ],
            'lengthMin' =>[
                'email' => 4,
                'login' => 4,
                'surname' => 3,
                'name'  => 3,
                'identification_number' => 5
            ],
            'lengthMax' =>[
                'email' => 200,
                'login' => 100,
                'name'  => 200,
                'surname' => 200,
                'identification_number' => 13
            ],
            'integer' => [
                ['identification_number', true]
            ],
            'date' => [
                ['birthday']
            ],
            'required' => $required,
            $equals
        ]);
        $v->validate();
        return $v->errors();
    }
}
