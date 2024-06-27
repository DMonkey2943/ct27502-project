<?php
session_start();

require_once __DIR__ . '/../src/bootstrap.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    redirect('/');
}

use CT27502\Project\Category;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = new Category($PDO);
    $category->fill($_POST);
    if ($category->validate()) {
        $_SESSION['flash_message'] = 'Thêm danh mục thành công';

        $category->save() && redirect('category_list.php');
    }

    $errors = $category->getValidationErrors();
}


include_once __DIR__ . '/../src/partials/header.php'
?>

<body>
    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <div class="container mb-4">
        <?php
        $subtitle = 'THÊM DANH MỤC';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row my-5">
            <div class="col-12">
                <form method="POST" class="col-md-6 offset-md-3">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="cat_name" class="mb-3">Tên danh mục<span class="red">*</span></label>
                        <input type="text" name="cat_name" class="form-control fs-5<?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="cat_name" value="<?= isset($_POST['cat_name']) ? html_escape($_POST['cat_name']) : '' ?>" />

                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary fs-4 mt-4 p-3 fw-bold">Thêm danh mục</button>
                </form>

            </div>
        </div>

        <a href="category_list.php" class="btn btn-secondary fs-4 py-2 px-3 text-light fw-medium">
            <i class="fa-solid fa-chevron-left text-light"></i>
            Trở về
        </a>

    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>
</body>

</html>