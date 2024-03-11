<?php include_once __DIR__ . '/../src/partials/header.php' ?>

<body>

    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>


    <div class="container">
        <div class="row ">
            <div class="col-md-4 my-5">
                <img class="img_product" src="./images/nhanLongHungYen.jpg" alt="" width="100%">                
            </div>
            <div class="col-md-7 offset-lg-1 my-5">
                <h3 class="title_product">Nhãn lồng Hưng Yên loại 1</h3>
                <p class="my-3"><b>Danh mục:</b> Trái cây Việt Nam</p>
                <p class="price_product my-4">155,000đ</p>
                <form action="" method="post">
                    <input type="number" name="quantity" id="" min="1" value="1" style="max-width: 80px;">
                    <input type="submit" class="add_product" value="Thêm vào giỏ hàng">
                </form>
                <div class="ms-5 my-4">
                    <p class="info_product">Đây là thông tin sản phẩm. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                </div>
            </div>
        </div>


    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>

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