<?php
session_start();

require_once __DIR__ . '/../src/bootstrap.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    redirect('/');
}
?>

<?php include_once __DIR__ . '/../src/partials/header.php' ?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <?php 
        use CT27502\Project\Order;

        $order = new Order($PDO);
        $order_codes = $order->allCode();
        

    ?>


    <div class="container">

        <?php
        $subtitle = 'QUẢN LÝ ĐƠN HÀNG';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <?php if(isset($_SESSION['flash_message'])): ?>
            <div id="flash_message" class="text-success text-center fw-semibold">
                <?= $_SESSION['flash_message'] ?>
            </div>
            <?php unset($_SESSION['flash_message']) ?>
        <?php endif ?>
        
        <!-- Table Starts Here -->
        <table id="contacts" class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <!-- <th scope="col">STT</th> -->
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Quản lý</th>
                </tr>
            </thead>
            <tbody class="text-center">
            <?php foreach ($order_codes as $order_code): ?>
                <tr>
                    
                    <!-- Mã đơn hàng -->
                    <td>
                        <?= $order_code?>
                    </td>

                    <!-- Tình trạng -->
                    <td>
                        <?php if($order->getStatus($order_code)) echo 'Đã giao hàng';
                                else echo 'Đang xử lý';
                        ?>
                    </td>
                   
                    <!-- Quản lý -->
                    <!-- <td><a href="order_detail.php">Xem chi tiết đơn hàng</a></td> -->

                    <!-- Quản lý -->
                    <td class="align-middle">
                        <div class="d-flex justify-content-center">
                            <a href=<?php echo 'order_detail.php?orderCode='.$order_code.''?> class="btn btn-xs btn-success fs-5 me-3">
                                <i class="fa-solid fa-list-ul"></i> Xem chi tiết đơn hàng
                            </a>
                            <form action="order_delete.php" method="POST" class="form-inline ml-1">
                                <input type="hidden" name="order_code" value="<?= $order_code?>">
                                <button type="submit" name="delete-order" class="btn btn-xs btn-danger fs-5 ms-3" data-bs-toggle="modal" data-bs-target="#delete-confirm">
                                    <i alt="Delete" class="fa fa-trash"></i> Xóa</a>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
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
            $('button[name="delete-order"]').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td:first');
                if (nameTd.length > 0) {
                    $('.modal-body').html(
                        `Bạn có chắc muốn xóa đơn hàng "${nameTd.text()}"?`
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