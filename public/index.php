<?php
define("ABS_PATH", __DIR__);

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "vendor/autoload.php";

session_start();

use aps\appcore\Config;
    try {
        Config::getInstance()->loadFileEnv();
    } catch(Exception $e) {
        echo "Erro ao chamar a classe manipuladora das variáveis de ambiente do projeto: <br>" . $e->getMessage();
    }
define("URL", getenv('URLBASE'));
require_once 'routes.php';






