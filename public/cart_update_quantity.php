<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Cart;

$item = new Cart($PDO);

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['quantity'])
    && isset($_POST['id_user']) && isset($_POST['id_pd'])
    && ($item->find($_POST['id_user'], $_POST['id_pd'])) !== null
    ){

        $item->updateQuantity($_POST['quantity'], $_POST['id_user'], $_POST['id_pd']);
        echo 'success';
        exit;
    
    }
    echo 'unsuccess';