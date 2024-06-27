<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Cart;

$item = new Cart($PDO);

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id_user']) && isset($_POST['id_pd'])
    && ($item->find($_POST['id_user'], $_POST['id_pd'])) !== null
) {
    $id = $_POST['id_user'];
    $item->delete();
    redirect('cart.php?id='.$id.'');
}
redirect('/');