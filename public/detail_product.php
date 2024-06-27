<?php 
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Product;
use CT27502\Project\Category;

$product = new Product($PDO);

$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
if($id<0 || !($product->find($id))) {
    redirect('/');
}

$category = new Category($PDO);

include_once __DIR__ . '/../src/partials/header.php' 
?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>


    <div class="container">
        <div class="row ">
            <!-- Hình ảnh -->
            <div class="col-md-4 my-5">
                <img class="img_product" src="<?= './uploads/' . html_escape($product->pd_image) ?>" alt="" width="100%">
            </div>
            <div class="col-md-7 offset-lg-1 my-5">
                <!-- Tên sản phẩm -->
                <h3 class="title_product"><?= html_escape($product->pd_name) ?></h3>

                <!-- Tên danh mục sản phẩm -->
                <p class="my-3"><b>Danh mục:</b> <?=html_escape($category->getNameByID($product->cat_id)) ?></p>
                
                <!-- Giá sản phẩm -->
                <p class="price_product my-4"><?= number_format(html_escape($product->pd_price)) . '₫' ?></p>
                
                

                    <!-- Nút thêm giỏ hàng -->
                    <?php if(isset($_SESSION['role']) && $_SESSION['role']=='user' && isset($_SESSION['name']) && isset($_SESSION['id'])){
                            $id = $_SESSION['id'];
                            echo'
                            <form action="cart_add.php" method="post">
                                <input type="hidden" name="idsanpham" value="'.$product->getID().'">
                                <input type="hidden" name="iduser" value="'.$_SESSION['id'].'">
                                <input type="submit" class="add_product" name = "themgiohang" value="Thêm vào giỏ hàng">
                            </form>
                            ';
                            }
                            else echo '<input type="submit" class="add_product" value="Thêm vào giỏ hàng" disabled>';
                    ?>

                
                <!-- Thông tin sản phẩm -->
                <div class="ms-5 my-4">
                    <p class="info_product"><?= html_escape($product->pd_info) ?></p>
                </div>
            </div>
        </div>


    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

    <script>
        var elementHTML = document.documentElement;
        var elementFooter = document.getElementsByTagName('footer')[0];

        elementHTML.style.position = "relative";
        elementHTML.style.minHeight = "100%";
        elementFooter.style.position = "absolute";
        elementFooter.style.bottom = "0";
        elementFooter.style.width = "100%";


        $(document).ready(function() {
            $('.increment_btn').click(function(e) {
                e.preventDefault();

                var qty = $('.pd_qty').val();
                var max = $('.pd_qty').attr('max');
                var min = $('.pd_qty').attr('min');

                var value = parseInt(qty, 10);
                

                if (value < max) {
                    value++;
                    $('.pd_qty').val(value);
                }
            });

            $('.decrement_btn').click(function(e) {
                e.preventDefault();

                var qty = $('.pd_qty').val();
                var min = $('.pd_qty').attr('min');

                var value = parseInt(qty, 10);
                
                if (value > min) {
                    value--;
                    $('.pd_qty').val(value);
                }
            });

        });
    </script>

</body>

</html>