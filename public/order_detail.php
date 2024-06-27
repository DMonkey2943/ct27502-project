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

    if ( isset($_GET['orderCode'])) {
        $orderInfor = $order->orderInfo($_GET);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
        $orderInfor->updateStatus($_POST);
        $_SESSION['flash_message'] = 'Cập nhật trạng thái đơn hàng thành công';
    }
    ?>
    <div class="container">

        <?php
        $subtitle = 'CHI TIẾT ĐƠN HÀNG';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <?php if(isset($_SESSION['flash_message'])): ?>
            <div class="text-success text-center fw-semibold">
                <?= $_SESSION['flash_message'] ?>
            </div>
            <?php unset($_SESSION['flash_message']) ?>
        <?php endif ?>

        <table class="mb-4">
            <tr>
                <td class="text-end pe-4 fw-bold">Mã đơn hàng:</td>
                <td><?= $orderInfor->getOrderCode() ?></td>
            </tr>
            <tr>
                <td class="text-end pe-4 fw-bold">Tên khách hàng:</td>
                <td><?= html_escape($orderInfor->getUserName()) ?></td>
            </tr>
            <tr>
                <td class="text-end pe-4 fw-bold">Số điện thoại:</td>
                <td><?= html_escape($orderInfor->phone) ?></td>
            </tr>
            <tr>
                <td class="text-end pe-4 fw-bold">Địa chỉ giao hàng:</td>
                <td><?= html_escape($orderInfor->address) ?></td>
            </tr>
            <tr>
                <td class="text-end pe-4 fw-bold">Tình trạng đơn hàng:</td>
                <form action="" method="POST">
                    <td>
                        <select class="form-select fs-4" name='status' aria-label="Default select example">
                            <?php
                            if ($orderInfor->order_status)
                                echo ' <option value="0"  >Đang xử lý</option>
                                    <option value="1" selected>Đã giao hàng</option>';
                            else 
                                echo '<option value="0"  selected >Đang xử lý</option>
                                <option value="1" >Đã giao hàng</option>'

                            ?>
                        </select>
                    </td>
                    <td>
                        <button type="submit" name="update_status" class="btn btn-primary fs-4 fw-medium ms-2">Cập nhật tình trạng</button>
                    </td>
                </form>
            </tr>
        </table>


        <!-- Table Starts Here -->
        <?php
            $pd = new Order($PDO);
            $pds = $pd->allPd($orderInfor->getOrderCode()) ;
            
        ?>
        <table id="contacts" class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <!-- <th scope="col">STT</th> -->
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                $tongtien = 0;
                foreach($pds as $pd):
                    $tongtien+=  $pd->getTotal();
                    
                ?>
                <tr>
                    <!-- Tên sản phẩm -->
                    <td>
                        <?= html_escape($pd->getNamePd())?>
                    </td>

                    <!-- Giá -->
                    <td class="text-end"><?= number_format($pd->getPricePd()) . '₫' ?></td>

                    <!-- Số lượng -->
                    <td><?= $pd->getQuantityPd()?></td>

                    <!-- Thành tiền -->
                    <td class="text-end"><?= number_format($pd->getTotal()) . '₫' ?></td>

                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4"><b>Tổng tiền:</b> <?= number_format($tongtien) . '₫' ?></td>
                </tr>

               
            </tbody>
        </table>

        <a href="order_list.php" class="btn btn-secondary fs-4 py-2 px-3 text-light fw-medium">
            <i class="fa-solid fa-chevron-left text-light"></i>
            Trở về
        </a>
    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

    
</body>

</html>