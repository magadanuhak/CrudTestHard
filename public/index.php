<?php

use site\app\core\APP;

error_reporting(E_ALL);

require '../vendor/autoload.php';

session_start();
// unset($_SESSION['USER']);
//todo is31z refactor this
//$_SESSION['USER']['name'] = $_SESSION['USER']['name'] ?: 'Guest';

APP::getInstance()->run();