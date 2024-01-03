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

            <meta name="google-site-verification" content="v6qzcPJLPYipiEcjo1Le-UfSjy4ep_yU6cqhmi003jI" />

            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZV3943RWDH"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-ZV3943RWDH');
            </script>

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
                            <li class="menu__item"><a href="cauchuyen.php" class="item__text">câu chuyện</a></li>
                            <li class="menu__item"><a href="shop.php" class="item__text">shop</a></li>
                            <li class="menu__item"><a href="noiban.php" class="item__text">Một & nơi bán</a></li>
                        </ul>
                    </div>
                    <a href="trangchu.php" class="header-1__logo"></a>
                    <div class="header-1__right-menu">
                        <ul class="right-menu__menu">
                            <li class="menu__item"><a href="trogiup_mangsizenaovua.php" class="item__text">trợ giúp</a></li>
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
                            <li class="menu__item"><a href="<?php echo $href; ?>" class="item__text" name="buttonClickCart">giỏ hàng (<?php echo $countProductInCart; ?>)</a></li>

                            <?php
                                if($_SESSION["login"] == "false") {
                                    echo '<li class="menu__item" style="display: block;"><span onclick="login(\'trangchu\')" class="item__text">đăng nhập</span></li>';
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
                        <li onclick="nextPage('thongtintaikhoan');" class="list__item check">thông tin</li>
                        <li onclick="nextPage('doimatkhau');" class="list__item">đổi mật khẩu</li>
                    </ul>
                </div>
                <div class="body__container">
                    <?php
                        $notice = $_SESSION["notice_thongtintaikhoan"];
                        if($_SESSION["notice_thongtintaikhoan"] != "" && $_SESSION["success_or_error_notice_thongtintaikhoan"] == true) {
                            echo "<div class=\"container__notice success\">$notice</div>";
                        } else if($_SESSION["notice_thongtintaikhoan"] != "" && $_SESSION["success_or_error_notice_thongtintaikhoan"] == false) {
                            echo "<div class=\"container__notice error\">$notice</div>";
                        }
                    ?>
                    <!-- <div class="container__notice"></div> -->
                    <div class="container__box show">
                        <form class="box__info" action="thongtintaikhoan.php" method="post">
                            <div class="info__group-info">
                                <label class="group-info__label" for="fullname">Tên: </label>
                                <input class="group-info__input" type="text" name="fullname" value="<?php echo $_SESSION["fullname"]; ?>" autocomplete="false">
                                <div onclick="clickButtonEdit(0);" class="group-info__button-edit">chỉnh sửa</div>
                                <button onclick="clickButtonSave(0);" class="group-info__button-save display-none" type="submit" name="saveFullname">Lưu</button>
                            </div>
                            <div class="info__group-info">
                                <label class="group-info__label" for="username">Tên đăng nhập: </label>
                                <input class="group-info__input" type="text" name="username" value="<?php echo $_SESSION["username"]; ?>" autocomplete="false">
                            </div>
                            <div class="info__group-info">
                                <label class="group-info__label" for="email">Email: </label>
                                <input class="group-info__input" type="text" name="email" value="<?php echo $_SESSION["email"]; ?>" autocomplete="false">
                                <div onclick="clickButtonEdit(1);" class="group-info__button-edit">chỉnh sửa</div>
                                <button onclick="clickButtonSave(1);" class="group-info__button-save display-none" type="submit" name="saveEmail">Lưu</button>
                            </div>
                            <div class="info__group-info">
                                <label class="group-info__label" for="phonenumber">Số điện thoại: </label>
                                <input class="group-info__input" type="text" name="phonenumber" value="<?php echo $_SESSION["phonenumber"]; ?>" autocomplete="false" required>
                                <div onclick="clickButtonEdit(2);" class="group-info__button-edit">chỉnh sửa</div>
                                <button onclick="clickButtonSave(2);" class="group-info__button-save display-none" type="submit" name="savePhonenumber">Lưu</button>
                            </div>
                            <div class="info__group-info">
                                <label class="group-info__label" for="address">Địa chỉ: </label>
                                <input class="group-info__input" type="text" name="address" value="<?php echo $_SESSION["address"]; ?>" autocomplete="false">
                                <div onclick="clickButtonEdit(3);" class="group-info__button-edit">chỉnh sửa</div>
                                <button onclick="clickButtonSave(3);" class="group-info__button-save display-none" type="submit" name="saveAddress">Lưu</button>
                            </div>
                        </form>

                        <?php
                            $id_account = $_SESSION["id_account"];

                            if(isset($_POST["saveFullname"])) {
                                $fullname = $_POST["fullname"];

                                if($fullname == "") {
                                    $_SESSION["notice_thongtintaikhoan"] = "Không được để trống phần tên!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = false;
                                    header("location:thongtintaikhoan.php");
                                } else {
                                    $sql = "UPDATE taikhoan SET hoten = '$fullname' WHERE id_taikhoan = $id_account";
                                    mysqli_query($conn, $sql);
                                    $_SESSION["notice_thongtintaikhoan"] = "Thay đổi thành công!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = true;
                                    $_SESSION["fullname"] = $fullname;
                                    header("location:thongtintaikhoan.php");
                                }
                            }
                            if(isset($_POST["saveEmail"])) {
                                $email = $_POST["email"];

                                if(!filter_var($email, 274)) {
                                    $_SESSION["notice_thongtintaikhoan"] = "Email không hợp lệ!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = false;
                                    header("location:thongtintaikhoan.php");
                                } else {
                                    $sql = "UPDATE taikhoan SET email = '$email' WHERE id_taikhoan = $id_account";
                                    mysqli_query($conn, $sql);
                                    $_SESSION["notice_thongtintaikhoan"] = "Thay đổi thành công!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = true;
                                    $_SESSION["email"] = $email;
                                    header("location:thongtintaikhoan.php");
                                }
                            }
                            if(isset($_POST["savePhonenumber"])) {
                                $phoneNumber = $_POST["phonenumber"];

                                $check = true;
                                $so_dau = $phoneNumber[0].$phoneNumber[1].$phoneNumber[2];

                                if(strlen($phoneNumber) < 10) {
                                    $check = false;
                                }

                                switch($so_dau) {
                                    case "070":
                                    case "079":
                                    case "077":
                                    case "076":
                                    case "078":
                                    case "089":
                                    case "090":
                                    case "093":
                                    case "083":
                                    case "084":
                                    case "085":
                                    case "081":
                                    case "082":
                                    case "088":
                                    case "091":
                                    case "094":
                                    case "032":
                                    case "033":
                                    case "034":
                                    case "035":
                                    case "036":
                                    case "037":
                                    case "038":
                                    case "039":
                                    case "086":
                                    case "096":
                                    case "097":
                                    case "098":
                                    case "056":
                                    case "058":
                                    case "092":
                                    case "059":
                                    case "099":
                                        break;
                                    default: {
                                        $check = false;
                                        $_SESSION["notice_thongtintaikhoan"] = "Số điện thoại không hợp lệ!";
                                        $_SESSION["success_or_error_notice_thongtintaikhoan"] = false;
                                        break;
                                    }
                                }

                                for($i = 0 ; $i < strlen($phoneNumber) ; ++$i) {
                                    switch($phoneNumber[$i]) {
                                        case "0":
                                        case "1":
                                        case "2":
                                        case "3":
                                        case "4":
                                        case "5":
                                        case "6":
                                        case "7":
                                        case "8":
                                        case "9":
                                            break;
                                        default: {
                                            $check = false;
                                            break;
                                        }
                                    }
                                    if($check == false) break;
                                }
                                if($check == false) {
                                    $_SESSION["notice_thongtintaikhoan"] = "Số điện thoại không hợp lệ!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = false;
                                    header("location:thongtintaikhoan.php");
                                } else {
                                    $sql = "UPDATE taikhoan SET sdt = '$phoneNumber' WHERE id_taikhoan = $id_account";
                                    mysqli_query($conn, $sql);
    
                                    $_SESSION["notice_thongtintaikhoan"] = "Thay đổi thành công!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = true;
                                    $_SESSION["phonenumber"] = $phoneNumber;
                                    header("location:thongtintaikhoan.php");
                                }

                            }
                            if(isset($_POST["saveAddress"])) {
                                $address = $_POST["address"];

                                if(strlen($address) == 0) {
                                    $_SESSION["notice_thongtintaikhoan"] = "Không được để trống phần địa chỉ!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = false;
                                    header("location:thongtintaikhoan.php");
                                } else if(strlen($address) != 0) {
                                    $sql = "UPDATE taikhoan SET diachi = '$address' WHERE id_taikhoan = $id_account";
                                    mysqli_query($conn, $sql);
                                    $_SESSION["notice_thongtintaikhoan"] = "Thay đổi thành công!";
                                    $_SESSION["success_or_error_notice_thongtintaikhoan"] = true;
                                    $_SESSION["address"] = $address;
                                    header("location:thongtintaikhoan.php");
                                }
                            }
                        ?>

                        <form class="box__avatar" action="xulidoiavatar.php" method="POST" enctype="multipart/form-data">
                            <input type="text" value="0" id="width" name="width" style="display: none;">
                            <input type="text" value="0" id="height" name="height" style="display: none;">
                            <input type="text" value="0" id="left" name="left" style="display: none;">
                            <input type="text" value="0" id="top" name="top" style="display: none;">
                            <div class="avatar__image">
                                <?php
                                    if($_SESSION['avatar'] == null) {
                                        echo '<i class="fa-solid fa-user icon"></i>';
                                    } else {
                                        $widthInfo = $width * 57 / 100;
                                        $heightInfo = $height * 57 / 100;
                                        $leftInfo = $left * 57 / 100;
                                        $topInfo = $top * 57 / 100;
                                        
                                        echo "<img src=\"./avatar/$avatar\" style=\"position: absolute; width: $widthInfo"."px; "."height: $heightInfo"."px; "."left: $leftInfo"."px; "."top: $topInfo"."px;\">";
                                    }
                                ?>
                            </div>
                            <div onclick="clickButtonInputFile();" class="avatar__buttonChangeImage">Thay đổi</div>
                            <input type="file" id="avatar__input-file" name="buttonChangeAvatar" style="display: none;">
                            <div class="body__background body__background-display-none">
                                <div class="background__box">
                                    <div id="box__show-avatar">
                                        <img alt="" id="show-avatar__avatar" draggable="false">
                                    </div>
                                    <input type="range" id="box__range" min="0" max="100" value="0" onmousemove="getValueRange(this.value);">
                                    <div class="box__buttons">
                                        <input type="reset" onclick="clickButtonCancelChangeAvatar();" class="buttons__button-cancel" name="buttonCancelChangeAvatar" value="Hủy">
                                        <input type="submit" class="buttons__button-submit" name="buttonSubmitChangeAvatar" value="Hoàn tất">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="container__box">
                        <form class="box__form" action="" method="post">
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
                            <button class="group-password__buttonChangePassword" type="submit" name="buttonChangePassword">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Javascript nhà làm -->
            <script src="./javascript/main_thongtintaikhoan.js"></script>
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>