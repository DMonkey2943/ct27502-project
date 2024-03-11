<?php

require_once 'functions.php';
require_once __DIR__ .'/../libraries/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;
$loader -> register();

$loader->addNamespace('CT27502\Project', __DIR__.'/classes');

try{
    $PDO = (new CT27502\Project\PDOFactory())->create([
        'dbhost' =>'localhost',
        'dbname' => 'ct27502-project',
        'dbuser' => 'root',
        'dbpass' => ''
    ]);
}catch(Exception $ex){
    echo 'Không thể kết nối tới MySQL, kiểm tra lại username/password.<br>',
    exit("<pre>$ex</pre>");

}