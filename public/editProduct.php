<?php include_once __DIR__ .'/../src/partials/header.php'?>
<body>
    
    <?php include_once __DIR__ .'/../src/partials/navbar.php'?>


    <div class="container">

        <?php
            $subtitle = 'Chỉnh sửa sản phẩm';
            include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">
                <form action="editProduct.php" method="post" class="col-md-6 offset-md-3">

                    <div class="form-group log-form-group">
                        <label for="name">Tên sản phẩm </label>
                        <input type="name" name="name" class="form-control mt-3 log-form-group-input" maxlen="255" id="name" placeholder="Nhập tên sản phẩm" value="" />
                    </div>

                     <div class="form-group log-form-group">
                        <legend>Loại</legend>
                        <div>
                            <input type="radio" name="category1" id="category1" value="" />
                            <label for="category1">Trái cây Việt Nam</label>
                        </div>

                        <div>
                            <input type="radio" name="category2" id="category2" value="" />
                            <label for="category2">Trái cây nhập khẩu</label>
                        </div>

                        <div>
                            <input type="radio" name="category3" id="category3" value="" />
                            <label for="category3">Quà tặng trái cây</label>
                        </div>
                        
                    
                    </div>

                    <div class="form-group log-form-group">
                        <label for="price">Giá sản phẩm </label>
                        <input type="number" name="price" class="form-control mt-3 log-form-group-input"  id="price" placeholder="Nhập giá tiền" value="" />
                    </div>

                    <div class="form-group log-form-group">
                        <label for="photo">Hình sản phẩm </label>
                        
                            
                            <input type="file" name="photo"  id="photo" class="d-block mt-3" value="" />
                        
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary btn-block log-btn">Cập nhật sản phẩm</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ .'/../src/partials/footer.php'?>
    
    <script>
      
        var elementHTML = document.documentElement; 
        var elementFooter = document.getElementsByTagName('footer')[0];

        elementHTML.style.position = "relative";
        elementHTML.style.minHeight="100%";  
        elementFooter.style.position="absolute";
        elementFooter.style.bottom ="0";
        elementFooter.style.width= "100%";

    </script>
</body>
    
</html>