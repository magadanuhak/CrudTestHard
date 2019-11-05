<?php
namespace site\app\controllers;

use site\app\core\View;

class MainController
{
    public function actionIndex (){
        return View::render('main/index');
    }

    public function actionContact (){
        return View::render('main/contact');
    }
}
