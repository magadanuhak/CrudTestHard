<?php
namespace site\app\controllers;

use site\app\models\Product;
use site\app\core\View;

class ProductsController
{
    public function actionIndex (){
        $product = new Product();
        return View::render('products/index', $product->getList());
    }
}
