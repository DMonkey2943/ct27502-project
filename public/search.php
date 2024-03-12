<?php include_once __DIR__ . '/../src/partials/header.php' ?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>


    <div class="container ">

        <?php
        $subtitle = 'TÌM KIẾM';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div>
            <p class="mt-3 mb-5">Kết quả tìm kiếm cho <b>"..."</b>:</p>
        </div>

        <div class="row hot-product-list mb-5">
            <div class="col-lg-2 col-4 card card-product">
                <a href="" class="product_a">
                    <img src="./images/daoTien.jpg" class="card-img-top" alt="...">
                    <div class="card-title-wrap">
                        <h6 class="card-title">Đào tiên Ngộ Không</h6>
                    </div>
                </a>
                <p class="card-text price-product">205,000đ</p>
                <button class="btn-add_cart">Thêm vào giỏ hàng</button>
            </div>
            <div class="col-lg-2 col-4 card card-product">
                <a href="" class="product_a">
                    <img src="./images/leHan.jpg" class="card-img-top" alt="...">
                    <div class="card-title-wrap">
                        <h6 class="card-title">Lê Hàn K-pear size 7</h6>
                    </div>
                </a>
                <p class="card-text price-product">165,000đ</p>
                <button class="btn-add_cart">Thêm vào giỏ hàng</button>
            </div>
            <div class="col-lg-2 col-4 card card-product">
                <a href="" class="product_a">
                    <img src="./images/taoRockit.jpg" class="card-img-top" alt="...">
                    <div class="card-title-wrap">
                        <h6 class="card-title">Táo Rockit New Zealand Jumbo (Lốc 4 trái, 424GR)</h6>
                    </div>
                </a>
                <p class="card-text price-product">135,000đ</p>
                <button class="btn-add_cart">Thêm vào giỏ hàng</button>
            </div>
            <div class="col-lg-2 col-4 card card-product">
                <a href="" class="product_a">
                    <img src="./images/nhoRuou.jpg" class="card-img-top" alt="...">
                    <div class="card-title-wrap">
                        <h6 class="card-title">Nho rượu Kyoho Premium Hàn Quốc</h6>
                    </div>
                </a>
                <p class="card-text price-product">395,000đ</p>
                <button class="btn-add_cart">Thêm vào giỏ hàng</button>
            </div>
            <div class="col-lg-2 col-4 card card-product">
                <a href="" class="product_a">
                    <img src="./images/nhoRuou.jpg" class="card-img-top" alt="...">
                    <div class="card-title-wrap">
                        <h6 class="card-title">Nho rượu Kyoho Premium Hàn Quốc</h6>
                    </div>
                </a>
                <p class="card-text price-product">395,000đ</p>
                <button class="btn-add_cart">Thêm vào giỏ hàng</button>
            </div>
            <div class="col-lg-2 col-4 card card-product">
                <a href="" class="product_a">
                    <img src="./images/nhoRuou.jpg" class="card-img-top" alt="...">
                    <div class="card-title-wrap">
                        <h6 class="card-title">Nho rượu Kyoho Premium Hàn Quốc</h6>
                    </div>
                </a>
                <p class="card-text price-product">395,000đ</p>
                <button class="btn-add_cart">Thêm vào giỏ hàng</button>
            </div>

            
        </div>
    </div>


    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

</body>

</html>