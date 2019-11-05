<?php

namespace site\app\controllers;

use site\app\core\View;
use site\app\models\User;
use site\app\Utils;
use Valitron\Validator;

class UserController
{
    public function actionIndex(){
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        $paginator = "";
//             $paginator = Utils::makePaginator('users', 'id', 10, $page);
        $data = [
            "paginator" => "" . $paginator,
            "users" => User::getInstance()->getList(10, $page)
        ];
        View::render('user/list', $data);

    }

    public function actionEdit($data){
        $data = [
            'user' => User::getInstance()->getUser($data),
            'user_groups' => User::getInstance()->getAllGroups()
        ];
        View::render('user/edit', $data);
    }
    public function actionAdd($data){
        if(isset($_POST['login'])) {
            $this->addUser();
        } else{
            View::render('user/add', ['user_groups' => User::getInstance()->getAllGroups()]);
        }
    }
    public function addUser(){
        $validator = $this->validate($_POST);
        if(empty($validator)) {
            User::getInstance()->addUser($_POST);
        } else{
            View::render('user/add', ['user_groups' => User::getInstance()->getAllGroups()]);
            Utils::showValidationErrors($validator);
        }
    }
    public function userUpdate($id){

    }

    public function actionDelete($data){
        $user = User::getInstance();
        if(\site\app\core\User::getInstance()->getSession('group_id') > $user->getUser($data)['group_id']) {
            $user->delete($data);
            var_dump($data['id']);
            header('Location: /users');
        }
    }

    public function validate($data, $required = [], $equals = []){
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
            'equals' => [$equals],
        ]);
        $v->validate();
        return $v->errors();
    }

}
