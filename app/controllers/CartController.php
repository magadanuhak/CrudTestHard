<?php
namespace site\app\controllers;

use site\app\models\Cart;
use site\app\core\View;


class CartController
{

    public function actionIndex(){
        $cart = new Cart();
        return View::render('cart/index', $cart->getAll());
    }

    public function actionAdd($params){
        if($params['id'] > 0) {
            //todo is31z make Cart singleton
            $cart = new Cart();
            $cart->add($params);

            return View::render('cart/add_success');
        }
        return View::render('cart/add_error');
    }

    public function actionRemove($params){
        $cart = new Cart();
        $cart->remove($params['id']);
        return View::render('cart/remove_success');
    }
}
