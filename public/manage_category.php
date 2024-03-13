<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Category;

$category = new Category($PDO);
$categories = $category->all();
$i = 0;

include_once __DIR__ . '/../src/partials/header.php'
?>

<body>
    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <div class="container">
        <?php
        $subtitle = 'QUẢN LÝ DANH MỤC';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row my-5">
            <div class="col-md-4">
                <h2>Thêm danh mục</h2>
                <form action="" method="POST">
                    <div>
                        <label for="cat_name">Tên danh mục</label>
                        <input type="text" class="form-control fs-5" name="cat_name" id="cat_name"> <br>
                    </div>
                    <input type="submit" name="add_cat" value="Thêm danh mục" class="btn btn-primary fs-5">
                </form>
            </div>

            <!-- Cập nhật -->
            <!-- <div class="col-md-4">
                <h4>Cập nhật danh mục</h4>
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="cat_id" value="5">
                    <div>
                        <label for="cat_name">Tên danh mục</label>
                        <input type="text" class="form-control fs-5" name="cat_name" id="cat_name" value="Tivi"> <br>
                    </div>
                    <input type="submit" name="update_cat" value="Cập nhật danh mục" class="btn btn-primary fs-5">
                </form>
            </div> -->

            <div class="col-md-8">
                <h2>Liệt kê danh mục</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    foreach ($categories as $category) :
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= html_escape($category->cat_name) ?></td>
                            <td>
                                <a href="?action=delete&id=">Xóa</a> ||
                                <a href="?action=update&id=">Cập nhật</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>
</body>

</html>