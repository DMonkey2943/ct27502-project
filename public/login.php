<?php include_once __DIR__ .'/../partials/header.php'?>
<body>
    
    <?php include_once __DIR__ .'/../partials/navbar.php'?>


    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <p class="animate__animated animate__fadeInLeft" >Đăng nhập</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="login.php" method="post" class="col-md-6 offset-md-3">

                     <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" class="form-control" maxlen="255" id="email" placeholder="Nhập email" value="" />
                    </div>

                    <div class="form-group">
                        <label for="psw">Mật khẩu: </label>
                        <input type="password" name="psw" class="form-control"  id="psw" placeholder="Nhập mật khẩu" value="" />
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ .'/../partials/footer.php'?>
    
</body>
    
</html>