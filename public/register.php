<?php 
require_once __DIR__ .'/../src/bootstrap.php';

use CT27502\Project\Profile;

$errors= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile = new Profile($PDO);
    $profile->fill($_POST);
    if($profile->validateR($_POST['psw2'])){
        $profile->save() && redirect('/');
    }
    $errors = $profile->getValidationErrors();

}

include_once __DIR__ .'/../src/partials/header.php'
?>
<body>
    
    <?php include_once __DIR__ .'/../src/partials/navbar.php'?>


    <div class="container">

        <?php
            $subtitle = 'ĐĂNG KÝ';
            include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">
                <form action="register.php" method="post" class="col-md-6 offset-md-3">

                    <div class="form-group log-form-group">
                        <label for="name">Họ Tên: </label>
                        <input type="name" name="name" class="form-control mt-3 log-form-group-input <?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="name" placeholder="Nhập họ và tên" value="<?= isset($_POST['name']) ? html_escape($_POST['name']) : '' ?>"  />
                        
                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                     <div class="form-group log-form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" class="form-control mt-3 log-form-group-input <?= isset($errors['email']) ? ' is-invalid' : '' ?>" maxlen="255" id="email" placeholder="Nhập email" value="<?= isset($_POST['email']) ? html_escape($_POST['email']) : '' ?>" />
                            
                        <?php if (isset($errors['email'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['email'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="form-group log-form-group">
                        <label for="psw">Mật khẩu: </label>
                        <input type="password" name="psw" class="form-control mt-3 log-form-group-input <?= isset($errors['psw']) ? ' is-invalid' : '' ?>"  id="psw" placeholder="Nhập mật khẩu từ 8-32 ký tự" value="<?= isset($_POST['psw']) ? $_POST['psw'] : '' ?>"/>
                            
                        <?php if (isset($errors['psw'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['psw'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="form-group log-form-group">
                        <label for="psw2">Nhập lại mật khẩu: </label>
                        <input type="password" name="psw2" class="form-control mt-3 log-form-group-input <?= isset($errors['psw2']) ? ' is-invalid' : '' ?>" maxlen="255" id="psw2" placeholder="Nhập lại mật khẩu" value="<?= isset($_POST['psw2']) ? $_POST['psw2'] : '' ?>" />
                            
                        <?php if (isset($errors['psw2'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['psw2'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary btn-block log-btn">Đăng ký</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ .'/../src/partials/footer.php'?>
    
</body>
    
</html>