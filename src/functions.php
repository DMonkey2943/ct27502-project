<?php

function redirect(string $location): void
{
    header('Location: ' . $location, true, 302);
    exit();
}

// Loại bỏ ký tự đặc biệt
function html_escape(string|null $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}

function handle_image_upload(): string | bool
{
    if (!isset($_FILES['image'])) {
        return false;
    }

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_size = $image['size'];
    $image_error = $image['error'];

    if($image_tmp_name=='') {
        return false;
    }
    // Kiểm tra loại file ảnh
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $image_info = getimagesize($image_tmp_name);
    $image_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    if (!in_array($image_type, $allowed_types) || !$image_info) {
        return false;
    }

    // Kiểm tra kích thước ảnh dưới 2MB
    if($image_error !== 0 || $image_size > 2000000) {
        return false;
    }
    
    $image_new_name = uniqid() . '_' . $image_name;
    $image_destination = __DIR__ . '/../public/uploads/' . $image_new_name;

    if (!move_uploaded_file($image_tmp_name, $image_destination)) {
        return false;
    }

    return $image_new_name;
}

function remove_image_file(string $filename): bool {
    $file_path = __DIR__ . '/../public/uploads/' . $filename;
    if(file_exists($file_path)) {
        return unlink($file_path);
    }
    
    return false;
}