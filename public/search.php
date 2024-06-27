<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Product;

$product = new Product($PDO);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $keyword = trim($_GET['keyword']);
    $products = $product->search($keyword);
}


include_once __DIR__ . '/../src/partials/header.php'
?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>


    <div class="container ">

        <?php
        $subtitle = 'TÌM KIẾM';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div>
            <!-- Không tìm thấy sản phẩm -->
            <?php if ($products === false) { ?>
                <p class="mt-3 mb-5">Không tìm thấy sản phẩm nào với từ khóa <b>"<?= html_escape($keyword) ?>"</b>!</p>

            <?php } else { ?> <!-- Tìm thấy sản phẩm -->
                <p class="mt-3 mb-5">Kết quả tìm kiếm sản phẩm với từ khóa <b>"<?= html_escape($keyword) ?>"</b>:</p>
            <?php } ?>
        </div>

        <div class="row hot-product-list mb-5">
            <?php
            if ($products !== false) : // Nếu tìm thấy sản phẩm thì hiển thị
                foreach ($products as $product) :
            ?>
                    <div class="col-lg-2 col-sm-4 col-6 card card-product">
                        <a href="detail_product.php?id=<?= $product->getID() ?>" class="product_a">
                            <img src="<?= './uploads/' . html_escape($product->pd_image) ?>" class="card-img-top" alt="...">
                            <div class="card-title-wrap">
                                <h6 class="card-title"><?= html_escape($product->pd_name) ?></h6>
                            </div>
                        </a>
                        <p class="card-text price-product"><?= number_format(html_escape($product->pd_price)) . '₫' ?></p>
                        <?php if(isset($_SESSION['role']) && $_SESSION['role']=='user' && isset($_SESSION['name']) && isset($_SESSION['id'])){
                            $id = $_SESSION['id'];
                            echo'
                            <form action="cart_add.php" method="post">
                                <input type="hidden" name="idsanpham" value="'.$product->getID().'">
                                <input type="hidden" name="iduser" value="'.$_SESSION['id'].'">
                                <button class="btn-add_cart" name = "themgiohang" style="width:100%;">Thêm vào giỏ hàng</button>
                            </form>
                            ';
                            }
                            else echo '<button class="btn-add_cart" disabled>Thêm vào giỏ hàng</button>';
                            ?>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>


    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

</body>

</html>