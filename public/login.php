<?php include_once __DIR__ .'/../src/partials/header.php'?>
<body>
    
    <?php include_once __DIR__ .'/../src/partials/navbar.php'?>


    <div class="container">

        <?php
            $subtitle = 'ĐĂNG NHẬP';
            include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">
                <form action="login.php" method="post" class="col-md-6 offset-md-3">

                     <div class="form-group log-form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" class="form-control mt-3 log-form-group-input" maxlen="255" id="email" placeholder="Nhập email" value="" />
                    </div>

                    <div class="form-group log-form-group">
                        <label for="psw">Mật khẩu: </label>
                        <input type="password" name="psw" class="form-control mt-3 log-form-group-input"  id="psw" placeholder="Nhập mật khẩu" value="" />
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary btn-block log-btn">Đăng nhập</button>
                    </div>
                    <br>
                    <div>
                        <p>Nếu chưa có tài khoản, hãy <a href="register.php">Đăng ký</a></p>
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