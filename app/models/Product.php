<?php
namespace site\app\models;

use site\app\core\DB;

class Product extends Model
{
    public function getList()
    {

        $products = $this->db->select('
            SELECT
                id,
                name,
                price
            FROM
                products
        ');

        return $products;
    }
}
