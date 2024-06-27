<?php
session_start();

require_once __DIR__ . '/../src/bootstrap.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    redirect('/');
}

use CT27502\Project\Category;

$category = new Category($PDO);

if($_SERVER['REQUEST_METHOD'] === 'POST' 
    && isset($_POST['id']) && ($category->find($_POST['id'])) !== NULL
) {
    $_SESSION['flash_message'] = 'Xóa danh mục thành công';

    $category->delete();
}

redirect('category_list.php');