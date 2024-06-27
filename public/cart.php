<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';
if(!isset($_SESSION['role']) || $_SESSION['role']!=='user') {
    redirect('login.php');
}
?>


<?php include_once __DIR__ . '/../src/partials/header.php' ?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <?php

    use CT27502\Project\Cart;
    use CT27502\Project\Order;

    $errors = [];

    $item = new Cart($PDO);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['thanhtoan']) && isset($_POST['address']) && isset($_POST['phone'])) {
        $item->fillInfo($_POST);
        if ($item->validateInfo()) {
            $order = new Order($PDO);
            $user_id = $_POST['thanhtoan_id_user'];
            $mahang = rand(0, 9999);
            $cartpds = $order->allPdFromCart($user_id);
            foreach ($cartpds as $cartpd) {
                $order->fill($mahang, $user_id, $cartpd, $_POST);
                if ($order->save()) {
                    $item->deleteToAddOrder($user_id, $cartpd);
                }
            }
            $_SESSION['successful-order-message'] = "Đặt hàng thành công! Quý khách vui lòng kiểm tra email để xem chi tiết đơn hàng";
        }

        $errors = $item->getValidationErrors();
    }

    if (isset($_SESSION['id'])) {
            $item->fillUser($_SESSION);
            $items = $item->all();
    }



    ?>

    <div class="container ">

        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <h1 class="mt-5 mb-4 fw-bold">GIỎ HÀNG</h1>
            </div>
        </div>

        <?php if (isset($_SESSION['successful-order-message'])) : ?>
            <div class="text-success text-center fw-semibold">
                <?= $_SESSION['successful-order-message'] ?>
            </div>
            <?php unset($_SESSION['successful-order-message']) ?>
        <?php endif ?>
        <div class="row">
            <div class="col-12">

                <!-- Table Starts Here -->
                <table id="contacts" class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col"></th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Tổng giá</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tongtien = 0;

                        foreach ($items as $item) :
                            $tongtien += $item->total;
                        ?>
                            <tr class="text-center align-middle">
                                <td>
                                    <img src="<?= './uploads/' . html_escape($item->pd_image) ?>" alt="" width="100px" height="100px" style="border-radius:8px;">
                                </td>
                                <td><?= html_escape($item->pd_name) ?></td>
                                <td>

                                    <!-- Số lượng sản phẩm -->
                                    <div class="d-flex justify-content-center me-5">
                                        <button class="input-group-text btn btn-success decrement_btn fs-4 fw-bold" style="margin-right: 10px;">–</button>
                                        <input type="hidden" class="id-user" value="<?= $item->getIDUser() ?>">
                                        <input type="hidden" class="id-pd" value="<?= $item->getIDPro() ?>">
                                        <input type="number" min="1" max="20" disabled name="quantity" class="pd_qty text-center" value="<?= number_format(html_escape($item->pd_quantity)) ?>" style="width: 50px;">
                                        <button class="input-group-text btn btn-success increment_btn fs-4 fw-bold" style="margin-left: 10px;">+</button>
                                    </div>

                                </td>
                                <td><?= number_format(html_escape($item->pd_price)) . '₫' ?></td>
                                <td><?= number_format(html_escape($item->total)) . '₫' ?></td>
                                <td>
                                    <form action="cart_delete.php" method="POST" class="form-inline ml-1">
                                        <input type="hidden" name="id_user" value="<?= $item->getIDUser() ?>">
                                        <input type="hidden" name="id_pd" value="<?= $item->getIDPro() ?>">
                                        <button type="submit" name="delete-cart-item" class="btn btn-danger fs-5" data-bs-toggle="modal" data-bs-target="#delete-confirm">
                                            <i alt='Delete' class="fa fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        <?php endforeach ?>

                    </tbody>
                </table>
                <!-- Table Ends Here -->
            </div>
        </div>
        <div class="row mb-4">
            <h3 class="text-center fw-bold">TỔNG TIỀN: <?= number_format(html_escape($tongtien)) . '₫' ?></h3>

            <form action="" method="post">
                <h3>Thông tin người nhận:</h3>
                <div class="form-group log-form-group">
                    <label for="address">Địa chỉ: </label>
                    <input type="text" name="address" class="form-control mt-3 log-form-group-input <?= isset($errors['address']) ? ' is-invalid' : '' ?>" maxlen="255" id="address" placeholder="Nhập địa chỉ nhận hàng" value="<?= isset($_POST['address']) ? html_escape($_POST['address']) : '' ?>" />

                    <?php if (isset($errors['address'])) : ?>
                        <span class="invalid-feedback">
                            <strong><?= $errors['address'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>

                <div class="form-group log-form-group">
                    <label for="phone">Số điện thoại: </label>
                    <input type="text" name="phone" class="form-control mt-3 log-form-group-input <?= isset($errors['phone']) ? ' is-invalid' : '' ?>" maxlen="255" id="phone" placeholder="Nhập số điện thoại người nhận" value="<?= isset($_POST['phone']) ? html_escape($_POST['phone']) : '' ?>" />

                    <?php if (isset($errors['phone'])) : ?>
                        <span class="invalid-feedback">
                            <strong><?= $errors['phone'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>
                <div class="text-center">
                    <input type="hidden" name="thanhtoan_id_user" value="<?= $item->getIDUser() ?>">
                    <?php
                    if ($tongtien == 0)
                        echo '<h3 style = "color: var(--primary-color)">Không có sản phẩm nào trong giỏ hàng</h3>';
                    else
                        echo '<input name="thanhtoan" type="submit" class="btn btn-success fs-3 fw-semibold "  value="Đặt hàng">'



                    ?>
                </div>
            </form>
        </div>
    </div>



    <!-- Modal xác nhận xóa hàng khỏi giỏ -->

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
            $('button[name="delete-cart-item"]').on('click', function(e) {
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

    <script>
        $(document).ready(function() {
            $('.increment_btn').click(function(e) {
                e.preventDefault();

                var parentDiv = $(this).closest('.d-flex');
                var user_id = parentDiv.find('.id-user').val();
                var pd_id = parentDiv.find('.id-pd').val();
                var qtyInput = parentDiv.find('.pd_qty');
                var qty = qtyInput.val();
                var max = qtyInput.attr('max');


                var value = parseInt(qty, 10);
                // value = isNaN(value) ? min : value;

                if (value < max) {
                    value++;
                    qtyInput.val(value);
                    updateQuantity(value, user_id, pd_id);
                }
            });

            $('.decrement_btn').click(function(e) {
                e.preventDefault();

                var parentDiv = $(this).closest('.d-flex');
                var user_id = parentDiv.find('.id-user').val();
                var pd_id = parentDiv.find('.id-pd').val();
                var qtyInput = parentDiv.find('.pd_qty');
                var qty = qtyInput.val();
                var min = qtyInput.attr('min');

                var value = parseInt(qty, 10);
                // value = isNaN(value) ? min : value;
                if (value > min) {
                    value--;
                    qtyInput.val(value);
                    updateQuantity(value, user_id, pd_id);
                }
            });

            function updateQuantity(quantity, user, pd) {
                $.ajax({
                    url: 'cart_update_quantity.php',
                    type: 'POST',
                    data: {
                        quantity: quantity,
                        id_user: user,
                        id_pd: pd
                    },
                    success: function(response) {
                        //console.log(response); 
                        if (response === 'success') {
                            window.location.href = 'cart.php?id=' + user;

                        } else {
                            window.location.href = '/';
                        }
                    },

                });
            }

        });
    </script>




</body>

</html>