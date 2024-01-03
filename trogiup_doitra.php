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
            <title>chăm sóc giày | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_trogiup_doitra.css">

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
                    <h1>đổi - trả</h1>
                </div>
            </div>
            <div class="body">
                <div class="body__options">
                    <ul class="options__list-options">
                        <li class="list-options__item">
                            <a href="trogiup_mangsizenaovua.php">mang size nào vừa ?</a>
                        </li>
                        <li class="list-options__item">
                            <a href="trogiup_chamsocgiay.php">chăm sóc giày</a>
                        </li>
                        <li class="list-options__item">
                            <a href="trogiup_cauhoithuonggap.php">câu hỏi thường gặp</a>
                        </li>
                        <li class="list-options__item">
                            <a class="checked" href="trogiup_doitra.php">đổi - trả</a>
                        </li>
                        <li class="list-options__item">
                            <a href="">liên hệ</a>
                        </li>
                    </ul>
                </div>
                <div class="body__contain-option">
                    <p>Một thực hiện chính sách đổi – trả dễ dàng để bạn luôn vui khi mua hàng!</p>
                    <p>mọi sản phẩm của Một đều được hưởng chính sách đổi – trả trong vòng <span style="font-weight: 700;">30 ngày</span> kể từ ngày giày được giao đi, khi thoả các điều kiện sau: </p>
                    <ul>
                        <li>giày chưa mang (đế giày còn mới nguyên)</li>
                        <li>giày còn nguyên vẹn không hư hỏng</li>
                        <li>túi và hộp giày còn mới nguyên, không hư hỏng và chưa qua sử dụng</li>
                    </ul>
                    <p>mời bạn lưu ý các điều sau khi đổi – trả Một sản phẩm:</p>
                    <h2>với trả hàng</h2>
                    <p>Một sẽ khấu trừ phí lưu kho 100.000đ/một đôi giày, khoản này chưa bao gồm tiền phí giao nhận hàng – tức là bạn sẽ phải chịu tiền phí vận chuyển khi trả lại sản phẩm và khoản tiền Một chuyển lại cho bạn sẽ bị trừ đi 100.000đ/một đôi giày</p>
                    <h2>với đổi hàng</h2>
                    <p>Một sẽ không khấu trừ phí lưu kho với trường hợp đổi giày tuy nhiên bạn sẽ phải chịu tiền phí vận chuyển trong quá trình đổi sản phẩm</p>
                    <p>chính sách đổi giày chỉ áp dụng đổi đồng giá; tức giày chất liệu nào sẽ được đổi size, màu, kiểu, cùng chất liệu, cùng giá bán; không áp dụng đổi khác chất liệu</p>
                    <p>với các sản phẩm được mua tại các điểm bán của Một đối tác, bạn vui lòng đổi trả tại đúng điểm bán</p>
                    <p>nếu bạn nghi ngờ sản phẩm mình mua mắc phải lỗi sản xuất, liên hệ ngay với Một qua e-mail hoặc trang facebook của Một; chúng tôi sẽ giải quyết các trường hợp đổi – trả nhanh nhất có thể</p>
                    <p>nếu bạn có nhầm lẫn trong khi mua hàng, đừng ngần ngại tìm đến team Một. chúng tôi sẽ làm mọi điều tốt nhất để hỗ trợ bạn trong khoảng thời gian ngắn nhất</p>
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