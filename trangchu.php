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
            <link rel="stylesheet" href="./css/main_trangchu.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/6567163726949f791135de41/1hgdatj8m';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
            </script>
            <!--End of Tawk.to Script-->
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
                                                echo '<li onclick="nextPage(\'thongtintaikhoan\');">Thông tin tài khoản</li>';
                                                echo '<li onclick="logout(\'trangchu\');">đăng xuất</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header__header-2">
                    <a href="cauchuyen.php" class="header-2__image-cauchuyen"></a>
                    <a href="" class="header-2__logo"></a>
                    <a href="shop.php" class="header-2__image-shop"></a>
                </div>
            </div>
            <!-- 

                ---------------------------BODY-------------------------------

             -->
            <div class="body">
                <div class="body__content-1">
                    <div class="content-1__icon"></div>
                    <div class="content-1__text">Tươm tất, đơn giản, và bền đẹp</div>
                    <div class="content-1__text">Một đôi giày cho mọi hoạt động hàng ngày</div>
                </div>

                <div class="body__content-2">Một đôi nguyên ngày</div>

                <div class="body__content-3">
                    <div class="content-3__slides-image">
                        <div class="slides-image__header">Một đôi giày</div>
                        <div class="slides-image__slides-contain">
                            <div class="slides-contain__slides">
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                                <div class="slides__image"></div>
                            </div>
                        </div>
                        <div class="slides-image__button-slides">
                            <div onclick="slidesContent3(0)" class="button-slides__button selected"></div>
                            <div onclick="slidesContent3(1)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(2)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(3)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(4)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(5)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(6)" class="button-slides__button no-select"></div>
                            <div onclick="slidesContent3(7)" class="button-slides__button no-select"></div>
                        </div>
                        <a class="slides-image__button" href="shop.php">SHOP</a>
                    </div>
                    <div class="content-3__image"></div>
                </div>

                <div class="body__content-5">
                    <div class="content-5__header">
                        <div class="header__line"></div>
                        <div class="header__text">Một bài viết</div>
                        <div class="header__line"></div>
                    </div>
                    <div class="content-5__images">
                        <a href=# class="images__dong-giay">
                            <div class="dong-giay__text">Các dòng giày của Một</div>
                        </a>
                        <a href=# class="images__mau-giay">
                            <div class="mau-giay__text">Nước ngọt – màu giày cuối hè</div>
                        </a>
                        <a href=# class="images__thiet-ke">
                            <div class="thiet-ke__text">Đá : thiết kế mới, chất liệu mới</div>
                        </a>
                    </div>                    
                </div>
            </div>
            <div class="body__content-4">
                    <div class="content-4__header">
                        <div class="header__line"></div>
                        <div class="header__text">Biết thêm về Một</div>
                        <div class="header__line"></div>
                    </div>
                    <div class="content-4__images">
                        <a href="cauchuyen.php" class="images__cau-chuyen">
                            <div class="cau-chuyen__text">Story</div>
                        </a>
                        <a href="shop.php" class="images__shop">
                            <div class="shop__text">Shop</div>
                        </a>
                        <a href="trogiup_mangsizenaovua.php" class="images__tro-giup">
                            <div class="tro-giup__text">Trợ giúp</div>
                        </a>
                    </div>                    
                </div>
    <!-- Email Marketing -->
    <div id="mc_embed_shell">
      <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
  <style type="text/css">
        #mc_embed_signup{background:#f8c03b;clear:left; font:14px Helvetica,Arial,sans-serif; width:600px;color:white;margin:15px;margin-left:auto;margin-right:auto;padding:20px;border-radius: 20px;}
        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
    <form action="https://ntt.us9.list-manage.com/subscribe/post?u=2fc9d1ea5b9bdf6b968b6c188&amp;id=93ee2652c7&amp;f_id=009c3de1f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
        <div id="mc_embed_signup_scroll"><h2>Email marketing</h2>
            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
            <div class="mc-field-group"><label for="mce-EMAIL">Email Address <span class="asterisk">*</span></label><input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value=""></div>
        <div id="mce-responses" class="clear foot">
            <div class="response" id="mce-error-response" style="display: none;"></div>
            <div class="response" id="mce-success-response" style="display: none;"></div>
        </div>
    <div aria-hidden="true" style="position: absolute; left: -5000px;">
        /* real people should not fill this in and expect good things - do not remove this or risk form bot signups */
        <input type="text" name="b_2fc9d1ea5b9bdf6b968b6c188_93ee2652c7" tabindex="-1" value="">
    </div>
        <div class="optionalParent">
            <div class="clear foot">
                <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe">
                <p style="margin: 0px auto;"><a href="http://eepurl.com/iE3Dg-" title="Mailchimp - email marketing made easy and fun"><span style="display: inline-block; background-color: transparent; border-radius: 4px;"><img class="refferal_badge" src="https://digitalasset.intuit.com/render/content/dam/intuit/mc-fe/en_us/images/intuit-mc-rewards-text-dark.svg" alt="Intuit Mailchimp" style="width: 220px; height: 40px; display: flex; padding: 2px 0px; justify-content: center; align-items: center;"></span></a></p>
            </div>
        </div>
    </div>
</form>
</div>
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script></div>
    <!-- Email Marketing -->
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
            <script src="./javascript/main_trangchu.js"></script>
            <script src="./javascript/chuyengiao.js"></script>

        </body>

    </html>