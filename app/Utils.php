<?php


namespace site\app;


use site\app\core\DB;

class Utils
{
    /**
    * Redirect with POST data.
    *
    * @param string $url URL.
    * @param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
    * @param array $headers Optional. Extra headers to send.
    */
    public static function redirect_post($url, array $data, array $headers = null, $method= 'POST') {
        $params = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        if (!is_null($headers)) {
            $params['http']['header'] = '';
            foreach ($headers as $k => $v) {
                $params['http']['header'] .= "$k: $v\n";
            }
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if ($fp) {
            echo @stream_get_contents($fp);
            die();
        } else {
            // Error
            throw new Exception("Error loading '$url', $php_errormsg");
        }
    }

    public static function makePaginator(string $table,string $field = 'id', int $perPage,int $current){
        $query = "SELECT {$field} FROM {$table} ";
        var_dump($query);
        $count = DB::getInstance()->numRows($query);

        $pages = ceil($count/$perPage);

        $paginator = [
          "c"
        ];
        return '
                ';

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