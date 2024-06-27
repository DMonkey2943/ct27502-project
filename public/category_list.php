<?php
session_start();

require_once __DIR__ . '/../src/bootstrap.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    redirect('/');
}

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

        <?php if(isset($_SESSION['flash_message'])): ?>
            <div id="flash_message" class="text-success text-center fw-semibold">
                <?= $_SESSION['flash_message'] ?>
            </div>
            <?php unset($_SESSION['flash_message']) ?>
        <?php endif ?>

        <div class="row">
            <div class="col-12">

                <a href="category_add.php" class="btn btn-primary mb-3 fs-4 p-3">
                    <i class="fa fa-plus"></i> Thêm danh mục
                </a>

                <!-- Table Starts Here -->
                <table id="contacts" class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">STT</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categories as $category) :
                            $i++;
                        ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?= html_escape($category->cat_name) ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="<?= 'category_edit.php?id=' . $category->getID() ?>" class="btn btn-xs btn-warning fs-5 me-3">
                                        <i alt="Edit" class="fa fa-pencil"></i> Chỉnh sửa</a>
                                    <form action="category_delete.php" method="POST" class="form-inline ml-1">
                                        <input type="hidden" name="id" value="<?= $category->getID() ?>">
                                        <button type="submit" name="delete-cat" class="btn btn-xs btn-danger fs-5 ms-3" data-bs-toggle="modal" data-bs-target="#delete-confirm">
                                            <i alt="Delete" class="fa fa-trash"></i> Xóa</a>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="delete-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3 fw-bold" id="staticBackdropLabel">Xác nhận xóa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger fs-5" id="delete">Xóa</button>
                    <button type="button" class="btn fs-5" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('button[name="delete-cat"]').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td:eq(1)');
                if (nameTd.length > 0) {
                    $('.modal-body').html(
                        `Bạn có chắc muốn xóa "${nameTd.text()}"?`
                    );
                }
                $('#delete-confirm').on('click', '#delete', function() {
                        form.trigger('submit');
                    });
            });
        });
    </script>
</body>

</html>