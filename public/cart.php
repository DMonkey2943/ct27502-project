<?php include_once __DIR__ . '/../partials/header.php' ?>

<body>

    <?php include_once __DIR__ . '/../partials/navbar.php' ?>


    <div class="container ">

        <?php
        $subtitle = 'GIỎ HÀNG';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

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
                        <tr class="text-center align-middle">
                            <td>
                                <img src="./images/nhanLongHungYen.jpg" alt="" width="100px" height="100px" style="border-radius:8px;">
                            </td>
                            <td>Nhãn lồng Hưng Yên loại 1</td>
                            <td>
                                <input type="number" min="1" name="quantity" value="2">
                            </td>
                            <td>155,000đ</td>
                            <td>310,000đ</td>
                            <td>
                                <form action="" method="POST" class="form-inline ml-1">
                                    
                                    <button type="submit" name="delete" class="btn btn-danger fs-5">
                                        <i alt='Delete' class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr class="text-center align-middle">
                            <td>
                                <img src="./images/nhanLongHungYen.jpg" alt="" width="100px" height="100px">
                            </td>
                            <td>Nhãn lồng Hưng Yên loại 1</td>
                            <td>
                                <input type="number" min="1" name="quantity" value="2">
                            </td>
                            <td>155,000đ</td>
                            <td>310,000đ</td>
                            <td>
                                <form action="" method="POST" class="form-inline ml-1">
                                    
                                    <button type="submit" name="delete" class="btn btn-danger fs-5">
                                        <i alt='Delete' class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr class="text-center align-middle">
                            <td>
                                <img src="./images/nhanLongHungYen.jpg" alt="" width="100px" height="100px">
                            </td>
                            <td>Nhãn lồng Hưng Yên loại 1</td>
                            <td>
                                <input type="number" min="1" name="quantity" value="2">
                            </td>
                            <td>155,000đ</td>
                            <td>310,000đ</td>
                            <td>
                                <form action="" method="POST" class="form-inline ml-1">
                                    
                                    <button type="submit" name="delete" class="btn btn-danger fs-5">
                                        <i alt='Delete' class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- <tr class="text-center align-middle">
                            <td colspan="6" class="fs-3 fw-semibold">Tổng tiền: 310,000đ</td>
                        </tr> -->
                        <tr class="text-center align-middle">
                            <td colspan="6">
                                <input type="submit" class="btn btn-success fs-5 fw-semibold" name="update_cart" value="Cập nhật giỏ hàng">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Table Ends Here -->
            </div>
        </div>
        <div class="row mb-4">
            <h3 class="text-center fw-bold">TỔNG TIỀN: ...</h3>
            <form action="" method="post" class="text-center">
                <input type="submit" class="btn btn-success fs-3 fw-semibold" name="checkOut" value="Thanh toán">
            </form>
        </div>
    </div>


    <?php include_once __DIR__ . '/../partials/footer.php' ?>

</body>

</html>