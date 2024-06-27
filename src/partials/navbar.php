<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid header_wrap">
                <a class="navbar-brand" href="/">
                    <img src="./images/logo.png" class="" alt="" height="60px">
                </a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-4">
                            
                           <?php  if(isset($_SESSION['role']) && $_SESSION['role']=='admin') 
                                    
                                   echo' <a class= "nav-link active" aria-current="page"  href="category_list.php">QUẢN LÝ DANH MỤC</a>';
                                    else 
                                        echo '<a class=nav-link active" aria-current="page" href="/">TRANG CHỦ</a>';
                                    
                            ?>
                            
                        </li>
                        <li class="nav-item mx-4 dropdown">
                             <?php  if(isset($_SESSION['role']) && $_SESSION['role']=='admin') 
                                     echo' <a class= "nav-link active" aria-current="page"  href="product_list.php">QUẢN LÝ SẢN PHẨM</a>';
                                    else 
                                        echo '<div class="nav-link active dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        SẢN PHẨM
                                    </div>
                                    <ul class="dropdown-menu fs-5 text ">
                                        <li><a class="dropdown-item" href="product.php?catID=1">Trái cây Việt Nam</a></li>
                                        <li><a class="dropdown-item" href="product.php?catID=2">Trái cây nhập khẩu</a></li>
                                        <li><a class="dropdown-item" href="product.php?catID=3">Quà tặng trái cây</a></li>
                                    </ul>';
                            ?>

                            
                        </li>
                        <li class="nav-item mx-4">
                            <?php 

                                if(isset($_SESSION['role']) && $_SESSION['role']=='admin')
                                    echo '<a class=nav-link active" aria-current="page" href="order_list.php">QUẢN LÝ ĐƠN HÀNG</a>';
                                else 
                                        if(isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role']=='user') {
                                            $id = $_SESSION['id'];
                                            echo '<a class=nav-link active" aria-current="page" href="cart.php?id='.$id.'">GIỎ HÀNG</a>';
                                        } else  echo '<a class=nav-link active" aria-current="page" href="login.php">GIỎ HÀNG</a>';
                                
                            
                            ?>
                            <!-- <a class="nav-link active" href="<
                            // if(isset($_SESSION['name']) && isset($_SESSION['id'])) {
                            //     $id = $_SESSION['id'];
                            //     echo 'cart.php?id='.$id;
                            // } else {
                            //     echo 'login.php';
                            // }
                            ?>">GIỎ HÀNG</a> -->
                        </li>
                        <?php
                        //echo $_SESSION['role'];
                             if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                                echo '
                                <li class="nav-item mx-4 dropdown">
                                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        ADMIN
                                    </a>
                                    <ul class="dropdown-menu fs-5 text">
                                        <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                                        
                                        
                                    </ul>
                                </li> ';
                            }else 

                                    if(isset($_SESSION['name'])  && isset($_SESSION['role']) && $_SESSION['role']=='user'){
                                        $name = $_SESSION['name'];
                                    
                                        echo '
                                            <li class="nav-item mx-4 dropdown">
                                                <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    '.html_escape(($name)).'
                                                </a>
                                                <ul class="dropdown-menu fs-5 text">
                                                    <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                                                    
                                                    
                                                </ul>
                                            </li> ';
                                        } else echo ' <li class="nav-item mx-4 dropdown">
                                                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            TÀI KHOẢN
                                                        </a>
                                                        <ul class="dropdown-menu fs-5 text">
                                                            <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                                                            <li><a class="dropdown-item" href="register.php">Đăng ký</a></li>
                                                            
                                                        </ul>
                                                    </li>';

                                    
                    
                        ?>
                    </ul>
                    <?php if((isset($_SESSION['role']) && $_SESSION['role']=='user') || !isset($_SESSION['role'])){ echo'
                    <form action="search.php" method="GET" class="d-flex" role="search">
                        <input class="form-control me-2 search_input" name="keyword" type="search" required placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                        <button class="btn px-0" type="submit"><i
                                class="icon_search fa-solid fa-magnifying-glass"></i></button>
                    </form>';
                        }
                    ?>
                </div>
            </div>
        </nav>
    </header>