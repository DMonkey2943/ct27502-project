<?php
session_start();

require_once __DIR__ . '/../src/bootstrap.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    redirect('/');
}

use CT27502\Project\Product;

$product = new Product($PDO);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && ($product->find($_POST['id']) !== NULL)) {
    remove_image_file($product->pd_image);
    $product->delete();
}

$_SESSION['flash_message'] = 'Xóa sản phẩm thành công';

redirect('product_list.php');