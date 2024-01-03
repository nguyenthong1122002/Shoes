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
            <title>Shop | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_shop.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

            <!--Start of Fchat.vn-->
            <script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=63822b45dacb124e9e2e3095" async="async"></script>
            <!--End of Fchat.vn-->
        </head>
        <body>
            <!-- 

                ----------------------------HEADER---------------------------

             -->
            <div class="header">
                <div class="header__header-1">
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
                                                echo '<li onclick="nextPage(\'thongtintaikhoan\');">Thông tin tài khoản</li>';
                                                echo '<li onclick="logout(\'shop\');">Đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header__box"></div>
                <a href="" class="header__header-2"></a>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <div class="body">
                <div class="body__menu">
                    <div class="menu__options">
                        Giày có dây
                        <div class="options__box-option">
                            <ul class="box-option__list">
                                <li onclick="ClickMenu('giay-da-co-day');" class="list__item">Giày da</li>
                                <li onclick="ClickMenu('giay-vai-co-day');" class="list__item">Giày vải</li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu__options">
                        Giày không dây
                        <div class="options__box-option">
                            <ul class="box-option__list">
                                <li onclick="ClickMenu('giay-da-khong-day')" class="list__item">Giày da</li>
                                <li onclick="ClickMenu('giay-vai-khong-day')" class="list__item">Giày vải</li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div onclick="clickMenu(4);" class="menu__options">miếng lót</div> -->
                    <a href="mieng_lot.php" class="menu__options" style="text-decoration: none;">Miếng lót</a>
                </div>

                <div class="body__contain">
                    <!-- ================================================ GIÀY DA CÓ DÂY -->
                    <div class="contain__box show"> 
                        <div class="box__image-product">
                            <span>Giày có dây đen tuyền</span>
                            <a href="giay_da_co_day_den_tuyen.php?idgiay=65">
                                Xem chi tiết
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="box__image-product">
                            <span>Giày có dây xám</span>
                            <a href="giay_da_co_day_xam_nhe.php?idgiay=66">
                                Xem chi tiết
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ================================================ GIÀY VẢI CÓ DÂY -->
                    <div class="contain__box" style="justify-content: center;">
                        <div class="box__colors">
                            <div onclick="ClickColor('giay-vai-co-day', 'nuoc-ngot');" class="colors__color check" style="background-color: var(--mau-nuoc-ngot);"></div>
                            <div onclick="ClickColor('giay-vai-co-day', 'qua-do');" class="colors__color" style="background-color: var(--mau-qua-do);"></div>
                            <div onclick="ClickColor('giay-vai-co-day', 'tim-than');" class="colors__color" style="background-color: var(--mau-tim-than);"></div>
                        </div>
                        <div class="box__image-product">
                            <span class="name-product">Giày vải nước ngọt</span>
                            <a class="link-product" href="giay_vai_co_day_nuoc_ngot.php?idgiay=67">
                                Xem chi tiết
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="box__colors">
                            <div onclick="ClickColor('giay-vai-co-day', 'vang-nghe');" class="colors__color" style="background-color: var(--mau-vang-nghe);"></div>
                            <div onclick="ClickColor('giay-vai-co-day', 'xam-that-su');" class="colors__color" style="background-color: var(--mau-xam-that-su);"></div>
                            <div onclick="ClickColor('giay-vai-co-day', 'xanh-la-cay');" class="colors__color" style="background-color: var(--mau-xanh-la-cay);"></div>
                        </div>
                    </div>
                    <!-- ================================================ GIÀY DA KHÔNG DÂY -->
                    <div class="contain__box">
                        <div class="box__image-product">
                            <span>Giày không dây đá</span>
                            <a href="giay_da_khong_day_da.php?idgiay=73">
                                Xem chi tiết
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="box__image-product">
                            <span>Giày không dây xám nhẹ</span>
                            <a href="giay_da_khong_day_xam_nhe.php?idgiay=74">
                                Xem chi tiết
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ================================================ GIÀY VẢI KHÔNG DÂY -->
                    <div class="contain__box" style="justify-content: center;">
                        <div class="box__colors">
                            <div onclick="ClickColor('giay-vai-khong-day', 'nuoc-ngot');" class="colors__color check" style="background-color: var(--mau-nuoc-ngot);"></div>
                            <div onclick="ClickColor('giay-vai-khong-day', 'qua-do');" class="colors__color" style="background-color: var(--mau-qua-do);"></div>
                            <div onclick="ClickColor('giay-vai-khong-day', 'tim-than');" class="colors__color" style="background-color: var(--mau-tim-than);"></div>
                        </div>
                        <div class="box__image-product">
                            <span class="name-product">Giày vải nước ngọt</span>
                            <a class="link-product" href="giay_vai_khong_day_nuoc_ngot.php?idgiay=75">
                                Xem chi tiết
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="box__colors">
                            <div onclick="ClickColor('giay-vai-khong-day', 'vang-nghe');" class="colors__color" style="background-color: var(--mau-vang-nghe);"></div>
                            <div onclick="ClickColor('giay-vai-khong-day', 'xam-that-su');" class="colors__color" style="background-color: var(--mau-xam-that-su);"></div>
                            <div onclick="ClickColor('giay-vai-khong-day', 'xanh-la-cay');" class="colors__color" style="background-color: var(--mau-xanh-la-cay);"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 

                ----------------------------FOOTER------------------------------------

             -->
            <div class="footer">
                <div class="footer-1">
                    <div class="footer-1__links">
                        <a href="cauchuyen.php" class="links__link">Story</a>
                        <a href="shop.php" class="links__link">Shop</a>
                    </div>
                    <div class="footer-1__links">
                        <a href="noiban.php" class="links__link">Một & nơi bán</a>
                        <a href="trogiup_mangsizenaovua.php" class="links__link">Trợ giúp</a>
                    </div>
                    <div class="footer-1__icon">
                        <i class="fa-brands fa-instagram icon"></i>
                        <i class="fa-brands fa-facebook-f icon"></i>
                    </div>
                </div>
                <div class="footer-2">
                    <a href="" class="footer-2__link">ĐIỀU KHOẢN SỬ DỤNG</a>
                    <a href="" class="footer-2__link">CHÍNH SÁCH BẢO MẬT</a>
                </div>
            </div>

            <!-- Javascript nhà làm -->
            <script src="./javascript/main_shop.js"></script>
            <script src="./javascript/chuyengiao.js"></script>

            <script>window.fbMessengerPlugins = window.fbMessengerPlugins || {init: function () {FB.init({appId: "165595813922837",autoLogAppEvents: true,xfbml: true,version: "v2.10",});}, callable: [],};window.fbAsyncInit = window.fbAsyncInit || function () {window.fbMessengerPlugins.callable.forEach(function (item) { item(); });window.fbMessengerPlugins.init();};setTimeout(function () {(function (d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) { return; }js = d.createElement(s);js.id = id;js.src = "//connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));}, 0);</script><div class="fb-customerchat" page_id="105087272427713" ref="" ></div>
        </body>
    </html>