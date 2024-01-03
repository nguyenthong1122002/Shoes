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
            <title>Mang size nào vừa ? | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_trogiup_mangsizenaovua.css">

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
            <div class="header">
                <div class="header__header-1">
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
                <div class="header__header-2">
                    <h1>mang size nào vừa ?</h1>
                </div>
            </div>
            <div class="body">
                <div class="body__options">
                    <ul class="options__list-options">
                        <li class="list-options__item">
                            <a class="checked" href="trogiup_mangsizenaovua.php">mang size nào vừa ?</a>
                        </li>
                        <li class="list-options__item">
                            <a href="trogiup_chamsocgiay.php">chăm sóc giày</a>
                        </li>
                        <li class="list-options__item">
                            <a href="trogiup_cauhoithuonggap.php">câu hỏi thường gặp</a>
                        </li>
                        <li class="list-options__item">
                            <a href="trogiup_doitra.php">đổi - trả</a>
                        </li>
                        <li class="list-options__item">
                            <a href="">liên hệ</a>
                        </li>
                    </ul>
                </div>
                <div class="body__contain-option">
                    <div class="contain-option__tabs">
                        <ul class="tabs__list">
                            <li onclick="ClickTab(0);" class="list__item checked-2">giày nữ</li>
                            <li onclick="ClickTab(1);" class="list__item">giày nam</li>
                            <li onclick="ClickTab(2);" class="list__item">miếng lót</li>
                        </ul>
                    </div>
                    <div class="contain-options__tab-content">
                        <div class="tab-content__content-1 show">
                            <div class="content-1__content-size-new">
                                <div class="content-size-new__title">Đời-mới</div>
                                <table class="content-size-new__table-size">
                                    <tr class="table-size__row">
                                        <td class="row__header-table">size</td>
                                        <td class="row__header-table">bề dài chân (cm)</td>
                                        <td class="row__header-table">bề ngang chân (cm)</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">35W</td>
                                        <td class="row__row-table">21.6 - 22.3</td>
                                        <td class="row__row-table">21 - 21.4</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">36W</td>
                                        <td class="row__row-table">22.3 - 22.9</td>
                                        <td class="row__row-table">21.4 - 21.9</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">37W</td>
                                        <td class="row__row-table">22.9 - 23.6</td>
                                        <td class="row__row-table">21.9 - 22.3</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">38W</td>
                                        <td class="row__row-table">23.6 - 24.3</td>
                                        <td class="row__row-table">22.3 - 22.8</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">39W</td>
                                        <td class="row__row-table">24.3 - 24.9</td>
                                        <td class="row__row-table">22.8 - 23.2</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">40W</td>
                                        <td class="row__row-table">24.9 - 25.6</td>
                                        <td class="row__row-table">23.2 - 23.7</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">41W</td>
                                        <td class="row__row-table">25.6 - 26.3</td>
                                        <td class="row__row-table">23.7 - 24.2</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="content-1__content-size-nor">
                                <div class="content-size-nor__title">Đời-thường</div>
                                <table class="content-size-nor__table-size">
                                    <tr class="table-size__row">
                                        <td class="row__header-table">size</td>
                                        <td class="row__header-table">bề dài chân (cm)</td>
                                        <td class="row__header-table">bề ngang chân (cm)</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">35W</td>
                                        <td class="row__row-table">21.3 - 22</td>
                                        <td class="row__row-table">19.8 - 21.2</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">36W</td>
                                        <td class="row__row-table">22 - 22.6</td>
                                        <td class="row__row-table">21.2 - 21.6</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">37W</td>
                                        <td class="row__row-table">22.6 - 23.3</td>
                                        <td class="row__row-table">21.6 - 22</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">38W</td>
                                        <td class="row__row-table">23.3 - 24</td>
                                        <td class="row__row-table">22 - 22.7</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">39W</td>
                                        <td class="row__row-table">24 - 24.6</td>
                                        <td class="row__row-table">22.7 - 23</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">40W</td>
                                        <td class="row__row-table">24.6 - 25.3</td>
                                        <td class="row__row-table">23 - 23.5</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">41W</td>
                                        <td class="row__row-table">25.3 - 26</td>
                                        <td class="row__row-table">23.5 - 24</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="content-1__content-how-to-measure-feet">
                                <div class="content-how-to-measure-feet__title">làm sao đo chân?</div>
                                <div class="content-how-to-measure-feet__steps">
                                    <div class="steps__step">
                                        <img class="step__image" src="./images/images_trogiup/step-1.webp" alt="">
                                        <h3 class="step__number">bước 1</h3>
                                        <p>
                                            - chọn một mặt phẳng<br>
                                            - lót một miếng giấy<br>
                                            - đứng lên giấy, sao cho gót chân chạm sát tường
                                        </p>
                                    </div>
                                    <div class="steps__step">
                                        <img class="step__image" src="./images/images_trogiup/step-2.webp" alt="">
                                        <h3 class="step__number">bước 2</h3>
                                        <p>
                                            - đo bề dài chân:<br>
                                            dùng bút đánh dấu điểm xa nhất của bàn chân tính từ gót chân, đo hai chân và chọn số đo lớn hơn
                                        </p>
                                    </div>
                                    <div class="steps__step">
                                        <img class="step__image" src="./images/images_trogiup/step-3.webp" alt="">
                                        <h3 class="step__number">bước 3</h3>
                                        <p>
                                            - đo bề ngang chân:<br>
                                            dùng thước dây siết nhẹ thành vòng ngay phần bè nhất của bàn chân; đo hai chân và chọn số đo lớn hơn
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content-1__note">
                                <div class="note__title">Một vài lưu ý khi đo chân</div>
                                <p class="note__text">
                                    - luôn <b>đo cả hai bàn chân</b> và chọn số đo lớn hơn<br>
                                    - nếu bề ngang chân to hơn, nên chọn size nam; nếu bề ngang chân mỏng hơn, nên chọn size nữ<br>
                                    - nên <b>siết nhẹ thước dây</b> khi đo bề ngang chân, vì giày cũng sẽ ôm sát theo chân<br>
                                    - luôn chọn size theo số đo lớn hơn (ví dụ: bàn chân nữ dài 22cm, tương ứng size 35W, nhưng vòng chân là 21.5cm thì nên chọn size 36)<br>
                                </p>
                            </div>
                        </div>
                        <div class="tab-content__content-2">
                            <div class="content-2__content-size-new">
                                <div class="content-size-new__title">Đời-mới</div>
                                <table class="content-size-new__table-size">
                                    <tr class="table-size__row">
                                        <td class="row__header-table">size</td>
                                        <td class="row__header-table">bề dài chân (cm)</td>
                                        <td class="row__header-table">bề ngang chân (cm)</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">39M</td>
                                        <td class="row__row-table">24.1 - 24.8</td>
                                        <td class="row__row-table">23.4 - 23.9</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">40M</td>
                                        <td class="row__row-table">24.8 - 25.5</td>
                                        <td class="row__row-table">23.9 - 24.3</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">41M</td>
                                        <td class="row__row-table">25.5 - 26.2</td>
                                        <td class="row__row-table">24.3 - 24.8</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">42M</td>
                                        <td class="row__row-table">26.2 - 26.8</td>
                                        <td class="row__row-table">24.8 - 25.2</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">43M</td>
                                        <td class="row__row-table">26.8 - 27.5</td>
                                        <td class="row__row-table">25.2 - 25.7</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">44M</td>
                                        <td class="row__row-table">27.5 - 28.2</td>
                                        <td class="row__row-table">25.7 - 26.2</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">45M</td>
                                        <td class="row__row-table">28.2 - 28.8</td>
                                        <td class="row__row-table">26.2 - 26.7</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="content-2__content-size-nor">
                                <div class="content-size-nor__title">Đời-thường</div>
                                <table class="content-size-nor__table-size">
                                    <tr class="table-size__row">
                                        <td class="row__header-table">size</td>
                                        <td class="row__header-table">bề dài chân (cm)</td>
                                        <td class="row__header-table">bề ngang chân (cm)</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">39M</td>
                                        <td class="row__row-table">23.8 - 24.6</td>
                                        <td class="row__row-table">23.2 - 23.6</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">40M</td>
                                        <td class="row__row-table">24.6 - 25.3</td>
                                        <td class="row__row-table">23.6 - 24.1</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">41M</td>
                                        <td class="row__row-table">25.3 - 26</td>
                                        <td class="row__row-table">24.1 - 24.6</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">42M</td>
                                        <td class="row__row-table">26 - 26.6</td>
                                        <td class="row__row-table">24.6 - 25</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">43M</td>
                                        <td class="row__row-table">26.6 - 27.3</td>
                                        <td class="row__row-table">25 - 25.5</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">44M</td>
                                        <td class="row__row-table">27.3 - 28</td>
                                        <td class="row__row-table">25.5 - 26</td>
                                    </tr>
                                    <tr class="table-size__row">
                                        <td class="row__row-table">45M</td>
                                        <td class="row__row-table">28 - 28.6</td>
                                        <td class="row__row-table">26 - 26.5</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="content-2__content-how-to-measure-feet">
                                <div class="content-how-to-measure-feet__title">làm sao đo chân?</div>
                                <div class="content-how-to-measure-feet__steps">
                                    <div class="steps__step">
                                        <img class="step__image" src="./images/images_trogiup/step-1.webp" alt="">
                                        <h3 class="step__number">bước 1</h3>
                                        <p>
                                            - chọn một mặt phẳng<br>
                                            - lót một miếng giấy<br>
                                            - đứng lên giấy, sao cho gót chân chạm sát tường
                                        </p>
                                    </div>
                                    <div class="steps__step">
                                        <img class="step__image" src="./images/images_trogiup/step-2.webp" alt="">
                                        <h3 class="step__number">bước 2</h3>
                                        <p>
                                            - đo bề dài chân:<br>
                                            dùng bút đánh dấu điểm xa nhất của bàn chân tính từ gót chân, đo hai chân và chọn số đo lớn hơn
                                        </p>
                                    </div>
                                    <div class="steps__step">
                                        <img class="step__image" src="./images/images_trogiup/step-3.webp" alt="">
                                        <h3 class="step__number">bước 3</h3>
                                        <p>
                                            - đo bề ngang chân:<br>
                                            dùng thước dây siết nhẹ thành vòng ngay phần bè nhất của bàn chân; đo hai chân và chọn số đo lớn hơn
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content-2__note">
                                <div class="note__title">Một vài lưu ý khi đo chân</div>
                                <p class="note__text">
                                    - luôn <b>đo cả hai bàn chân</b> và chọn số đo lớn hơn<br>
                                    - nếu bề ngang chân to hơn, nên chọn size nam; nếu bề ngang chân mỏng hơn, nên chọn size nữ<br>
                                    - nên <b>siết nhẹ thước dây</b> khi đo bề ngang chân, vì giày cũng sẽ ôm sát theo chân<br>
                                    - luôn chọn size theo số đo lớn hơn (ví dụ: bàn chân nữ dài 22cm, tương ứng size 35W, nhưng vòng chân là 21.5cm thì nên chọn size 36)<br>
                                </p>
                            </div>
                        </div>
                        <div class="tab-content__content-3">
                            <p style="margin-top: 50px;">Một cặp miếng lót được chia size như bên dưới.</p>
                            <p style="margin-bottom: 40px;">Nhờ bạn đọc kỹ hướng dẫn trước khi đặt mua và trước khi sử dụng !</p>

                            <img src="./images/images_san-pham/khac/mieng-lot-size-guide.webp" alt="" style="width: 682px; margin-bottom: 10px;">
                            <img src="./images/images_san-pham/khac/mot-mieng-lot-giay-cat.jpg" alt="" style="width: 682px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="footer-1">
                    <div class="footer-1__links">
                        <a href="cauchuyen.php" class="links__link">câu chuyện</a>
                        <a href="shop.php" class="links__link">shop</a>
                    </div>
                    <div class="footer-1__links">
                        <a href="noiban.php" class="links__link">Một & nơi bán</a>
                        <a href="trogiup_mangsizenaovua.php" class="links__link">trợ giúp</a>
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

            <script src="./javascript/main_trogiup_mangsizenaovua.js"></script>
            <script src="./javascript/chuyengiao.js"></script>

            <script>window.fbMessengerPlugins = window.fbMessengerPlugins || {init: function () {FB.init({appId: "165595813922837",autoLogAppEvents: true,xfbml: true,version: "v2.10",});}, callable: [],};window.fbAsyncInit = window.fbAsyncInit || function () {window.fbMessengerPlugins.callable.forEach(function (item) { item(); });window.fbMessengerPlugins.init();};setTimeout(function () {(function (d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) { return; }js = d.createElement(s);js.id = id;js.src = "//connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));}, 0);</script><div class="fb-customerchat" page_id="105087272427713" ref="" ></div>
        </body>
    </html>