<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT27502\Project\Product;
use CT27502\Project\Category;
use CT27502\Project\Paginator;

$product = new Product($PDO);


$category = new Category($PDO);
$categories = $category->all();

// Pagination
$limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int)$_GET['limit'] : 12;
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;
$paginator = new Paginator(
    totalRecords: (isset($_GET['catID'])) ? $product->count($_GET['catID']) : $product->count(-1), //Nếu tồn tại catID thì gọi hàm đếm số lượng sp với tham số là catID, ngược lại tham số là -1
    recordsPerPage: $limit,
    currentPage: $page
);
$products = $product->paginate($paginator->recordOffset, $paginator->recordsPerPage, (isset($_GET['catID']) ? $_GET['catID'] : -1));
$pages = $paginator->getPages(length: 3);



include_once __DIR__ . '/../src/partials/header.php'
?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>


    <div class="container">
        <?php
        $subtitle = (isset($_GET['catID'])) ? html_escape($category->getNameByID($_GET['catID'])) : 'TẤT CẢ SẢN PHẨM';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>
        <div class="row">
            <div class="col-lg-2 col-md-4 my-3 pb-3 sidebar_category" style="height: 100%;">
                <h3 style="border-bottom: 2px solid #CCC; padding-bottom: 10px;">Danh mục sản phẩm</h3>
                <ul class="category">
                    <li class="category_item">
                        <a href="product.php" class="category_link">Tất cả sản phẩm</a>
                    </li>
                    <?php
                    foreach ($categories as $category) :
                    ?>
                        <li class="category_item">
                            <a href="product.php?catID=<?= html_escape($category->getID()) ?>" class="category_link"><?= html_escape($category->cat_name) ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="col-lg-10 col-md-8">
                <div class="row hot-product-list">
                    <?php
                    foreach ($products as $product) :
                    ?>
                        <div class="col-lg-3 col-sm-4 col-6 card card-product">
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
                    <?php endforeach ?>
                </div>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item <?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
                            <a role="button" href="product.php?<?= (isset($_GET['catID'])) ? 'catID='.html_escape($_GET['catID']).'&' : '' ?>page=<?= $paginator->getPrevPage() ?>&limit=12" class="page-link">
                                <span>&laquo;</span>
                            </a>
                        </li>
                        <?php foreach ($pages as $page) : ?>
                            <li class="page-item <?= $paginator->currentPage === $page ? ' active' : '' ?>">
                                <a role="button" href="product.php?<?= (isset($_GET['catID'])) ? 'catID='.html_escape($_GET['catID']).'&' : '' ?>page=<?= $page ?>&limit=12" class="page-link">
                                    <?= $page ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                        <li class="page-item <?= $paginator->getNextPage() ? '' : ' disabled' ?>">
                            <a role="button" href="product.php?<?= (isset($_GET['catID'])) ? 'catID='.html_escape($_GET['catID']).'&' : '' ?>page=<?= $paginator->getNextPage() ?>&limit=12" class="page-link">
                                <span>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

</body>

</html>