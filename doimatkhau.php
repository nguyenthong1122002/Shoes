<?php
    session_start();
    ob_start();

    $dbHost = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "dbmot"; // Add the database name here

    $conn = mysqli_connect($dbHost, $userName, $password, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "UTF8");
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="./images/logo-da-cat-nen-den.png"/>
            <title>Một đôi nguyên ngày | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/css_thongtintaikhoan.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        </head>
        <body>
            <!-- 

                ----------------------------HEADER---------------------------

            -->
            <div class="header">
                <div class="header__header-1 fixed">
                    <div class="header-1__left-nemu">
                        <ul class="left-menu__menu">
                            <li class="menu__item"><a href="cauchuyen.php" class="item__text">Story</a></li>
                            <li class="menu__item"><a href="shop.php" class="item__text">Shop</a></li>
                            <li class="menu__item"><a href="noiban.php" class="item__text">Một & nơi bán</a></li>
                        </ul>
                    </div>
                    <a href="trangchu.php" class="header-1__logo"></a>
                    <div class="header-1__right-menu">
                        <ul class="right-menu__menu">
                            <li class="menu__item"><a href="trogiup_mangsizenaovua.php" class="item__text">Trợ giúp</a></li>
                            <?php
                                $countProductInCart = 0;
                                $href = null;
                                if($_SESSION['login'] == "true") {
                                    $id_account = $_SESSION['id_account'];
                                    $sql = "SELECT * FROM giohang WHERE id_taikhoan = '$id_account'";
                                    $rows = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($rows)) {
                                        $countProductInCart = $countProductInCart + $row['soluong'];
                                    }

                                    $href = "giohang.php";
                                } else if($_SESSION['login'] == "false") {
                                    $href = "dangnhap.php?linkpage=shop";
                                }
                            ?>
                            <li class="menu__item"><a href="<?php echo $href; ?>" class="item__text" name="buttonClickCart">Giỏ hàng (<?php echo $countProductInCart; ?>)</a></li>
                            <?php
                                if($_SESSION["login"] == "false") {
                                    echo '<li class="menu__item" style="display: block;"><span onclick="login(\'trangchu\')" class="item__text">Đăng nhập</span></li>';
                                } else {
                                    $avatar = $_SESSION['avatar'];
                                    
                                    echo '<li class="menu__item" style="border-bottom: none;">';
                                    echo '<div class="item__avatar">';
                                    if($_SESSION['avatar'] == null || $_SESSION['avatar'] == "") {
                                        echo '<i class="fa-solid fa-user icon"></i>';
                                    } else {
                                        $id_account = $_SESSION['id_account'];
                                        
                                        $sql = "SELECT * FROM thongso_avatar WHERE id_taikhoan = $id_account";
                                        $result = mysqli_query($conn, $sql);
                                        
                                        $row = mysqli_fetch_assoc($result);
                                        
                                        $width = $row['chieurong_goc'];
                                        $height = $row['chieudai_goc'];
                                        $left = $row['trai_goc'];
                                        $top = $row['tren_goc'];
                                        
                                        $widthIcon = $width * 17 / 100;
                                        $heightIcon = $height * 17 / 100;
                                        $leftIcon = $left * 17 / 100;
                                        $topIcon = $top * 17 / 100;
                                        
                                        echo "<img class=\"avatar__avatar\" src=\"./avatar/$avatar\" style=\"width: $widthIcon"."px; "."height: $heightIcon"."px; "."left: $leftIcon"."px; "."top: $topIcon"."px;\">";
                                    }
                                        echo '</div>';
                                        echo '<div class="item__options">';
                                            echo '<ul>';
                                                echo '<li onclick="nextPage(\'thongtintaikhoan\');">thông tin tài khoản</li>';
                                                echo '<li onclick="logout(\'trangchu\');">đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="header__box"></div>
                <div class="header__header-2"></div>
            </div>
            <!-- 

                ----------------------------BODY---------------------------

            -->
            <div class="body">
                <div class="body__narbar">
                    <ul class="narbar__list">
                        <li onclick="nextPage('thongtintaikhoan');" class="list__item">Thông tin</li>
                        <li onclick="nextPage('doimatkhau');" class="list__item check">Đổi mật khẩu</li>
                    </ul>
                </div>
                <div class="body__container">
                    <?php
                        $notice = $_SESSION["notice_thongtintaikhoan"];
                        if($_SESSION["notice_thongtintaikhoan"] != "" && $_SESSION["success_or_error_notice_thongtintaikhoan"] == true) {
                            echo "<div class=\"container__notice success\">$notice</div>";
                            $_SESSION['notice_thongtintaikhoan'] = "";
                        } else if($_SESSION["notice_thongtintaikhoan"] != "" && $_SESSION["success_or_error_notice_thongtintaikhoan"] == false) {
                            echo "<div class=\"container__notice error\">$notice</div>";
                            $_SESSION['notice_thongtintaikhoan'] = "";
                            $_SESION['success_or_error_notice_thongtintaikhoan'] = true;
                        }
                    ?>
                    <!-- <div class="container__notice"></div> -->
                    <div class="container__box show">
                        <form class="box__form" action="xulidoimatkhau.php" method="POST">
                            <div class="form__group-password">
                                <label for="oldPassword" class="group-password__label">Mật khẩu hiện tại: </label>
                                <input type="password" class="group-password__input" name="oldPassword">
                            </div>
                            <div class="form__group-password">
                                <label for="newPassword" class="group-password__label">Mật khẩu mới: </label>
                                <input type="password" class="group-password__input" name="newPassword">
                            </div>
                            <div class="form__group-password">
                                <label for="verifyNewPassword" class="group-password__label">Xác nhận mật khẩu: </label>
                                <input type="password" class="group-password__input" name="verifyNewPassword">
                            </div>
                            <input class="group-password__buttonChangePassword" type="submit" name="buttonChangePassword" value="Xác nhận">
                        </form>
                    </div>
                </div>
            </div>

            <!-- Javascript nhà làm -->
            <script src="./javascript/main_thongtintaikhoan.js"></script>
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>