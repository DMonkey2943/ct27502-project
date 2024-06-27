<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Product;
use CT27502\Project\Category;

$product = new Product($PDO);

$category = new Category($PDO);
$categories = $category->all();


include_once __DIR__ .'/../src/partials/header.php'

?>
<body>
    
    <?php include_once __DIR__ .'/../src/partials/navbar.php'?>

    <div class="slider container mt-4 pb-0">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="./images/banner-1.jpg" class="d-block w-100 img-carousel" alt="...">
                </div>
                <div class="carousel-item " data-bs-interval="3000">
                    <img src="./images/banner-2.jpg" class="d-block w-100 img-carousel" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="./images/banner-3.jpg" class="d-block w-100 img-carousel" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="./images/banner-4.jpg" class="d-block w-100 img-carousel" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="./images/banner-5.jpg" class="d-block w-100 img-carousel" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="main-content">
        <div class="container my-4">
            <?php foreach ($categories as $category) : ?>
                <section class="container-fluid category-hot">
                    <div class="row cat-name">
                        <h2 class="title"><?= html_escape($category->cat_name) ?></h2>
                    </div>
                    <div class="row hot-product-list">
                        <?php $hotProducts = $product->showHotProducts(html_escape($category->getID())) ;
                        foreach ($hotProducts as $hotProduct) :
                        ?>
                        <div class="col-lg-2 col-sm-4 col-6 card card-product">
                            <a href="detail_product.php?id=<?= $hotProduct->getID() ?>" class="product_a">
                                <img src="<?= './uploads/' . html_escape($hotProduct->pd_image) ?>" class="card-img-top" alt="...">
                                <div class="card-title-wrap">
                                    <h6 class="card-title"><?= html_escape($hotProduct->pd_name) ?></h6>
                                </div>
                            </a>
                            <p class="card-text price-product"><?= number_format(html_escape($hotProduct->pd_price)) . '₫'?></p>
                            <?php if(isset($_SESSION['role']) && $_SESSION['role']=='user' && isset($_SESSION['name']) && isset($_SESSION['id'])){
                            $id = $_SESSION['id'];
                            echo'
                            <form action="cart_add.php" method="post">
                                <input type="hidden" name="idsanpham" value="'.$hotProduct->getID().'">
                                <input type="hidden" name="iduser" value="'.$_SESSION['id'].'">
                                <button class="btn-add_cart" name = "themgiohang" style="width:100%;">Thêm vào giỏ hàng</button>
                            </form>
                            ';
                            }
                            else echo '<button class="btn-add_cart" disabled>Thêm vào giỏ hàng</button>';
                            ?>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <div class="text-center">
                        <a href="product.php?catID=<?=html_escape($category->getID())?>">
                            <button class="btn-all_product">
                                Xem tất cả sản phẩm <b><?= html_escape($category->cat_name) ?></b>
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </a>
                    </div>
                </section>
            <?php endforeach ?>

        </div>
    </div>

    <?php include_once __DIR__ .'/../src/partials/footer.php'?>
    
</body>

</html>