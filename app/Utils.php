<?php

namespace site\app;

use site\app\core\DB;
use site\app\core\View;

class Utils
{

    public static function makePaginator(string $table,string $field = 'id', int $perPage,int $current, $queryCondition = ''){
        $query = "SELECT {$field} FROM {$table}  {$queryCondition}";
        $count = DB::getInstance()->numRows($query);
        $pages =(int) ceil($count/$perPage) ;
        $firstDisabled = ($current <= 1) ? 'disabled': '';
        $lastDisabled = (($current >= $pages)) ? 'disabled': '';
        $paginator = [
            'Prevoius' => [
                'class' => $firstDisabled,
                'href' => ($current - 1)
            ],
            1 => [
                'class' => '',
                'href' => 1
            ]
            ,
            $current => [
                'class' => 'active',
                'href' => ''
             ],
            ($pages)  => [
                'class' => ($current == $pages) ?'active' : '',
                'href' => $pages
            ],
            'Next' => [
                'class' => $lastDisabled,
                'href' => ($current + 1)
            ]

        ];
        return View::render('utils/paginator', $paginator);
    }

    public static function formatDate($date, $format = "Y-m-d H:i:s"){
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    public static function showValidationErrors($fields){
        foreach ($fields as $field => $errors){
        ?>
            <div class="alert alert-danger" role="alert">
        <?   foreach ($errors as $error){
                echo $error;
            }
        ?>
            </div>
        <?
        }
    }

}