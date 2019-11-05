<?php


namespace site\app\models;

use site\app\core\DB;

class Model
{
    public $db = null;

    public function __construct()
    {
        $this->db =  DB::getInstance();
    }

}