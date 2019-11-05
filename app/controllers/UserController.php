<?php

namespace site\app\controllers;

use site\app\core\View;
use site\app\models\User;

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

    public function actionUdate(){

    }

    public function actionDelete($data){
        $user = User::getInstance();
        if(\site\app\core\User::getInstance()->getSession('group_id') > $user->getUser($data)['group_id']) {
            $user->delete($data);
            var_dump($data['id']);
            header('Location: /users');
        }
    }


}
