<?php 
require_once __DIR__ . '/../src/bootstrap.php';
use CT27502\Project\Cart;

$item = new Cart($PDO);

if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['themgiohang']) && isset($_POST['idsanpham']) && isset($_POST['iduser'])  ) {
    
    $item->fill($_POST);
    if ($item->exist()) {
        $item->plus(1);
    } else {
        $item->save();
    }
    $id = $_POST['iduser'];
    redirect('cart.php?id='.$id.'');
}
redirect('/');