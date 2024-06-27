<?php
session_start();

require_once __DIR__ . '/../src/bootstrap.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    redirect('/');
}

use CT27502\Project\Product;
use CT27502\Project\Category;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product = new Product($PDO);
    $product->fill($_POST);
    $product->validate();

    // Nếu không hợp lệ, lấy thông báo lỗi
    $errors = $product->getValidationErrors();
    
    $img_file = empty($errors) ? handle_image_upload($errors) : false;

    if ($img_file === false || $img_file === NULL) {
        $errors['pd_image'] = "Ảnh không hợp lệ.";
    }

    if (empty($errors)) {
        // Kiểm tra hợp lệ và lưu dữ liệu sản phẩm
        if ($product->validate()) {

            $product->pd_image = $img_file;

            $_SESSION['flash_message'] = 'Thêm sản phẩm thành công';

            $product->save() && redirect('product_list.php');
        }
    }
}


$category = new Category($PDO);
$categories = $category->all();

include_once __DIR__ . '/../src/partials/header.php'
?>

<body>
    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <div class="container mb-4">
        <?php
        $subtitle = 'THÊM SẢN PHẨM';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row my-5">
            <div class="col-12">
                <form method="POST" enctype="multipart/form-data" class="col-md-6 offset-md-3">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="pd_name" class="mt-4 mb-2">Tên sản phẩm<span class="red">*</span></label>
                        <input type="text" name="pd_name" class="form-control fs-5<?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="pd_name" value="<?= isset($_POST['pd_name']) ? html_escape($_POST['pd_name']) : '' ?>" />

                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Image -->
                    <div class="form-group">
                        <label for="pd_image" class="mt-4 mb-2">Hình ảnh (&#8804 2MB)<span class="red">*</span></label>
                        <input type="file" id="pd_image" name="image" accept="image/*" class="form-control fs-5<?= isset($errors['pd_image']) ? ' is-invalid' : '' ?>" id="pd_image" />

                        <?php if (isset($errors['pd_image'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['pd_image'] ?></strong>
                            </span>
                        <?php endif ?>
                        <?php if (isset($errors['pd_image-size'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['pd_image-size'] ?></strong>
                            </span>
                        <?php endif ?>
                        <div class="preview_img my-2 mx-5" style="display: none;">
                            <span>Preview image: </span>
                            <img src="" class="imagePreview" alt="" width="80px" height="80px">
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="pd_price" class="mt-4 mb-2">Giá<span class="red">*</span></label>
                        <input type="text" name="pd_price" class="form-control fs-5<?= isset($errors['price']) ? ' is-invalid' : '' ?>" maxlen="255" id="pd_price" value="<?= isset($_POST['pd_price']) ? html_escape($_POST['pd_price']) : '' ?>" />

                        <?php if (isset($errors['price'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['price'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Info -->
                    <div class="form-group">
                        <label for="pd_info" class="mt-4 mb-2">Thông tin sản phẩm<span class="red">*</span></label>
                        <textarea name="pd_info" class="form-control fs-5<?= isset($errors['info']) ? ' is-invalid' : '' ?>" id="pd_info" rows="5"><?= isset($_POST['pd_info']) ? html_escape($_POST['pd_info']) : '' ?></textarea>

                        <?php if (isset($errors['info'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['info'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="cat" class="mt-4 mb-2">Loại sản phẩm<span class="red">*</span></label>
                        <select name="cat_id" id="cat" class="form-select fs-5">
                            <?php
                            foreach ($categories as $category) :
                            ?>
                                <option value="<?= $category->getID() ?>"><?= html_escape($category->cat_name) ?></option>
                            <?php endforeach ?>
                        </select>

                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>


                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary fs-4 mt-4 p-3 fw-bold">Thêm sản phẩm</button>
                </form>

            </div>
        </div>

        <a href="product_list.php" class="btn btn-secondary fs-4 py-2 px-3 text-light fw-medium">
            <i class="fa-solid fa-chevron-left text-light"></i>
            Trở về
        </a>
    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

    <script>
        $(function() {
            $('#pd_image').on("change", function(event) { //Sự kiện được kích hoạt khi chọn file ảnh 
                var file = event.target.files[0]; //Truy cập vào file đã chọn
                var reader = new FileReader(); //Tạo một đối tượng FileReader mới để đọc dữ liệu từ file được chọn.
                reader.onload = function(e) { //Sự kiện được kích hoạt khi file đã được đọc hoàn toàn
                    $('.imagePreview').attr('src', e.target.result);
                    $('.preview_img').show();
                }
                reader.readAsDataURL(file); //Đọc file và chuyển đổi nó thành một data URL có thể sử dụng để hiển thị hình ảnh.
            });
        });
    </script>
</body>

</html>