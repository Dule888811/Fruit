<?php
if(!isset($_SESSION)){
    session_start();
}
$GLOBALS['config'] = array(
    'DB' => array(
        'host' => '127.0.0.1' ,
        'user' => 'root' ,
        'password' => '' ,
        'db_name' => 'fruit'
    ),
    'status' => true,
    'app_dir' => 'C:/xampp/htdocs/Fruit/' ,
    'session' => array()
);
spl_autoload_register(function($className){
    require_once "classes/{$className}.class.php";
});
$pdo = Connect::getInstance();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>