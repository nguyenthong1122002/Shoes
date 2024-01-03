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
            <title>Một & nơi bán | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_noiban.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                                                echo '<li onclick="nextPage(\'thongtintaikhoan\');">thông tin tài khoản</li>';
                                                echo '<li onclick="logout(\'noiban\');">đăng xuất</li>';
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
                    <div class="header-2__title">Một & nơi bán</div>
                    <div class="header-2__slides">
                        <div class="slides__image active"></div>
                        <div class="slides__image"></div>
                        <div class="slides__image"></div>
                        <div class="slides__image"></div>
                    </div>
                    <div class="slides__button">
                        <div onclick="slideMoveLeftToRight()" class="button__button-left"><i class="fa-sharp fa-solid fa-chevron-left"></i></div>
                        <div onclick="slideMoveRightToLeft()" class="button__button-right"><i class="fa-sharp fa-solid fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <div class="body">
                <p>
                    <i>Chào bạn, trong thời gian dịch covid-19, một sẽ liên tục cập nhật tình trạng mở cửa của các điểm bán. Để chắc rằng điểm bán bạn muốn đến có mở cửa và sẵn sàng tiếp đón,</i> <b>hãy gọi hotline trước khi ghé bạn nhé!</b>
                </p>
                <p>
                    Bạn đang ở Sài Gòn? Hà Nội? Nha Trang? Phú Quốc? Đà Lạt? 
                </p>
                <p>
                    Chúng tôi cũng vậy!
                </p>
                <p>
                    Một hiện đang có mặt tại: 
                </p>
                <p>
                    <b>Biker Shield</b>: 158/10 Nguyễn Công Trứ, quận 1,  Sài Gòn 
                    <br>Mở cửa thứ hai – thứ bảy từ 8:00 sáng đến 6:00 chiều, chủ nhật từ 10:00 sáng đến 6:00 chiều
                    <br>Hotline – 096 614 0115
                </p>
                <p>
                    <b>Vesta Lifestyle & Gifts:</b>
                    <br>1. 33A Thảo Điền, phường Thảo Điền, quận 2, Sài Gòn
                    <br>Mở cửa hàng ngày từ 09:00 sáng đến 09:00 tối
                    <br>Hotline – 070 244 6153
                </p>
                <p>
                    2. 34 Ngô Quang Huy, phường Thảo Điền, quận 2, Sài Gòn
                    <br>Mở cửa hàng ngày từ 09:00 sáng đến 09:00 tối
                </p>
                <p>
                    <b>The Craft House Thương Xá Tax:</b>
                </p>
                <p>
                    1. 107 Nguyễn Huệ, phường Bến Nghé, quận 01, Sài Gòn
                    <br>Mở cửa hàng ngày từ 8:00 sáng đến 10:00 tối
                    <br>Hotline – 038 478 9763
                </p>
                <p>
                    2. 32 Đồng Khởi, phường Bến Nghé, quận 1, Sài Gòn
                    <br>Mở cửa hàng ngày từ 8:00 sáng đến 10:00 tối
                </p>
                <p>
                    <b>Okkio Caffe:</b>  
                </p>
                <p>
                    1. 35 Nguyễn Văn Tráng, phường Bến Thành, quận 01, Sài Gòn 
                    <br>Mở cửa hàng ngày từ 08:00 sáng đến 09:00 tối
                    <br>Hotline – 033 318 8286
                </p>
                <p>
                    2. 110 Xuân Thủy, phường Thảo Điền, quận 2, Sài Gòn
                    <br>Mở cửa hàng ngày từ 07:30 sáng đến 10:00 tối
                    <br>Hotline – 0899188386
                </p>
                <p>
                    3. 41/1 Phạm Ngọc Thạch, phường 6, quận 3, Sài Gòn
                    <br>Mở cửa hàng ngày từ 07:30 sáng đến 10:00 tối
                    <br>Hotline – 089 918 8286
                </p>
                <p>
                    <b>Ki-ốt Bà Na:</b> Lầu 1, 281 Nguyễn Công Trứ, phường Nguyễn Thái Bình, quận 1, Sài Gòn 
                    <br>Mở cửa hàng ngày từ 11:00 trưa đến 09:00 tối
                    <br>Hotline: 090 228 9445
                    <br>*lưu ý: đặt lịch hẹn trước khi đến.
                </p>
                <p>
                    <b>Là Việt Coffee:</b> 200 Nguyễn Công Trứ, Phường 8, Thành phố Đà Lạt, Lâm Đồng
                    <br>Mở cửa hàng ngày từ 08:00 sáng đến 18:00 chiều
                    <br>Hotline – 098 952 0749
                </p>
                <p>
                    <b>Tiệm cà phê Hoa hồng:</b> 123 Yersin, Phường 9, Thành phố Đà Lạt, Lâm Đồng 
                    <br>Mở cửa hàng ngày từ 07:30 sáng đến 09:30 tối
                    <br>Hotline – 096 355 9822
                </p>
                <p>
                    <b>Lam.Lam:</b> 04, Bến Cá, phường Phương Sài, Nha Trang
                    <br>Mở cửa hàng ngày từ 09:00 sáng đến 09:00 tối
                    <br>Hotline – 079 363 7805
                </p>
                <p>
                    <b>Loca:</b> Thửa đất 60, tờ bản đồ 122, tổ 3, đường Trần Hưng Đạo, khu phố 7, thị trấn Dương Đông, huyện Phú Quốc, tỉnh Kiên Giang (Phía trước Chuồn Chuồn bistro & sky bar)
                    <br>Mở cửa hàng ngày từ 08:00 sáng đến 10:30 tối
                    <br>Hotline – 077 309 0920
                </p>
                <p>
                    <b>Đây Đó:</b> số 4, ngõ 69 Đặng Văn Ngữ, phường Khương Thượng, quận Đống Đa, Hà Nội (ngõ cạnh Bánh mì Cột điện)
                    <br>Mở cửa hàng ngày từ 09:00 sáng đến 09:30 tối
                    <br>Hotline – 096 783 9266 
                </p>
                <p>
                    <b>Xin-chào:</b> Ngõ 41, đường Tây Hồ, phường Quảng An, quận Tây Hồ, Hà Nội
                    <br>Mở cửa hàng ngày từ 11:00 sáng đến 07:00 tối
                    <br>Hotline – 084 939 4900
                </p>
                <p>
                    <b>Faifo Tailor:</b> 90 Nguyễn Chí Thanh, Cẩm Hà, Hội An
                    <br>Mở cửa hàng ngày từ 08:30 sáng đến 09:30 tối
                    <br>Hotline – 098 129 1299
                </p>
                <p>
                    <b>The Three-H:</b> 602 Cách mạng tháng Tám, Thủ Dầu Một, Bình Dương
                    <br>Mở cửa hàng ngày từ 09:00 sáng đến 09:00 tối
                    <br>Hotline – 093 571 1971
                </p>
                <br><br><br>
                <p>
                    Mời bạn ghé thăm Một!
                </p>
                <p>
                    Mọi thắc mắc hãy gửi thư đến: hello@motdoigiay.vn
                </p>
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
            <script src="./javascript/main_noiban.js"></script>
            <script src="./javascript/chuyengiao.js"></script>

            <script>window.fbMessengerPlugins = window.fbMessengerPlugins || {init: function () {FB.init({appId: "165595813922837",autoLogAppEvents: true,xfbml: true,version: "v2.10",});}, callable: [],};window.fbAsyncInit = window.fbAsyncInit || function () {window.fbMessengerPlugins.callable.forEach(function (item) { item(); });window.fbMessengerPlugins.init();};setTimeout(function () {(function (d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) { return; }js = d.createElement(s);js.id = id;js.src = "//connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));}, 0);</script><div class="fb-customerchat" page_id="105087272427713" ref="" ></div>
        </body>
    </html>