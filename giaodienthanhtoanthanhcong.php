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
            <title>Giỏ hàng | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_chung.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/main_thanhtoanthanhcong.css">

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
                            <li class="menu__item"><a href="<?php echo $href; ?>" class="item__text" name="buttonClickCart">giỏ hàng (0)</a></li>
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
                                                echo '<li onclick="logout(\'shop\');">đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header__box"></div>
                <a href="" class="header__header-2">Thanh toán</a>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <?php
                $tongTien = $_GET["tong"];
                $tenKhachHang = $_SESSION["fullname"];
                $idTaiKhoan = $_SESSION["id_account"];
                $ngay = date("d/m/Y");

                $sql = "INSERT INTO donhang (id_taikhoan, ngay, tongtien) VALUES ($idTaiKhoan, $ngay, $tongTien)";
                $result = mysqli_query($conn, $sql);

                $sql = "SELECT * FROM donhang WHERE id_donhang = (SELECT MAX(id_donhang) FROM donhang)";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $idDonHang = $row["id_donhang"];
            ?>
            <div class="body">
                <span style="font-size: 22px; font-weight: 600;">Cảm ơn bạn đã mua hàng</span>

                <div class="body__order">
                    <span style="font-size: 26px;">Đơn hàng của bạn</span>
                    <table class="order__table" rules="cols">
                        <tr>
                            <td style="font-size: 18px; font-weight: 700;">Mã đơn hàng</td>
                            <td style="font-size: 18px; font-weight: 700;">Tên khách hàng</td>
                            <td style="font-size: 18px; font-weight: 700;">Ngày</td>
                            <td style="font-size: 18px; font-weight: 700;">Tổng tiền</td>
                        </tr>
                        <tr>
                            <td><?php echo $idDonHang; ?></td>
                            <td><?php echo $tenKhachHang; ?></td>
                            <td><?php echo $ngay; ?></td>
                            <td><?php echo number_format($tongTien, 0, '.', ','); ?> VND</td>
                        </tr>
                    </table>
                </div>


                <div class="body__order-details">
                    <span style="font-size: 26px;">Chi tiết đơn hàng</span>
                    <table class="order-details__table" rules="rows" frame="box" style="border-color: var(--mau-xam-that-su);">
                        <tr>
                            <td style="font-size: 18px; font-weight: 700;">Tên giày | size | số lượng</td>
                            <td style="font-size: 18px; font-weight: 700;">Giá</td>
                            <td style="font-size: 18px; font-weight: 700;">Tổng</td>
                        </tr>
                <?php
                    $sql = "SELECT * FROM giohang WHERE id_taikhoan = $idTaiKhoan";
                    $rows = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($rows)) {
                        $idGiay = $row["id_giay"];
                        $idSize = $row["id_size"];
                        $soLuong = $row["soluong"];

                        $sql = "SELECT * FROM giay WHERE id_giay = $idGiay";
                        $result = mysqli_query($conn, $sql);
                        $temp = mysqli_fetch_assoc($result);

                        $tenGiay = $temp["tengiay"];
                        $gia = $temp["gia"];
                        $size = $idSize + 34;
                        $tong = $soLuong * $gia;


                        echo "<tr>";
                            echo "<td>$tenGiay, $size <b>x$soLuong</b></td>";
                            echo "<td>".number_format($gia, 0, '.', ',')." VND</td>";
                            echo "<td>".number_format($tong, 0, '.', ',')." VND</td>";
                        echo "</tr>";

                        $sql = "INSERT INTO chitietdonhang VALUES ($idDonHang, $idGiay, $idSize, $soLuong, $tong)";
                        $result = mysqli_query($conn, $sql);

                        $sql = "DELETE FROM giohang WHERE id_taikhoan = $idTaiKhoan AND id_giay = $idGiay";
                        $result = mysqli_query($conn, $sql);
                    }
                ?>
                    </table>
                </div>
            </div>
            <!-- 

                ----------------------------FOOTER------------------------------------

             -->
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

            <!-- Javascript nhà làm -->
            <script src="./javascript/chuyengiao.js"></script>
        </body>
    </html>