<?php 
require_once __DIR__ .'/../src/bootstrap.php';

use CT27502\Project\Profile;

session_start();
$errors= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile = new Profile($PDO);
    $profile->fill($_POST);
    if($profile->validateL()){
        $_SESSION['name'] = $profile->name;
        $_SESSION['email'] = $profile->email;
       $_SESSION['role'] = $profile->getRole();
        $_SESSION['id'] = $profile->getID();
        redirect('/');
    } 
    $errors = $profile->getValidationErrors();

}


include_once __DIR__ .'/../src/partials/header.php'
?>

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
                        <input type="email" name="email" class="form-control mt-3 log-form-group-input" maxlen="255" id="email" placeholder="Nhập email" value="<?= isset($_POST['email']) ? html_escape($_POST['email']) : '' ?>" />
                    </div>

                    <div class="form-group log-form-group">
                        <label for="psw">Mật khẩu: </label>
                        <input type="password" name="psw" class="form-control mt-3 log-form-group-input <?= isset($errors['psw']) ? ' is-invalid' : '' ?>"  id="psw" placeholder="Nhập mật khẩu" value="<?= isset($_POST['psw']) ? $_POST['psw'] : '' ?>" />
                        <?php if (isset($errors['psw'])) :  ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['psw'] ?></strong>
                            </span>
                        <?php endif ?>
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
    
   
</body>
    
</html>