<?php
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

            <!-- Icon và tên cửa sổ -->
            <link rel="shortcut icon" type="image/png" href="./images/logo-da-cat-nen-den.png"/>
            <title>Đăng ký tài khoản | MỘT</title>

            <!-- Css nhà làm -->
            <link rel="stylesheet" href="./css/css_taotaikhoan.css">
            <link rel="stylesheet" href="./css/css_mau.css">
            <link rel="stylesheet" href="./css/css_chung.css">

            <!-- Css icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

            <!-- Font chữ có sẵn -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        </head>
        <body>
            <div class="background"></div>
            <form class="form" action="" method="post">
                <div class="form__group">
                    <label for="fullname" class="group__label">Họ tên</label>
                    <input type="text" class="group__input" name="fullname" required>
                </div>
                <div class="form__group">
                    <label for="username" class="group__label">Tên đăng nhập</label>
                    <input type="text" class="group__input" name="username" required>
                </div>
                <div class="form__group">
                    <label for="password" class="group__label">Mật khẩu</label>
                    <input type="password" class="group__input" name="password" required>
                </div>
                <div class="form__group">
                    <label for="verify_password" class="group__label">Xác nhận mật khẩu</label>
                    <input type="password" class="group__input" name="verify_password" required>
                </div>
                <div class="form__group">
                    <label for="phonenumber" class="group__label">Số điện thoại</label>
                    <input type="tel" class="group__input" name="phonenumber" required>
                </div>
                <div class="form__group">
                    <label for="email" class="group__label">Email</label>
                    <input type="email" class="group__input" name="email" required>
                </div>
                <button class="button_register" type="submit" name="buttonregister">Đăng ký</button>
            </form>

            <?php
                if(isset($_POST["buttonregister"])) {
                    $fullname = $_POST["fullname"];
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $verify_password = $_POST["verify_password"];
                    $phonenumber = $_POST["phonenumber"];
                    $email = $_POST["email"];
                    $error = "";

                    // Kiểm tra xác nhận mật khẩu
                    if($password != $verify_password) {
                        $error = "Xác nhận mật khẩu không chính xác!";
                    }

                    // Kiểm tra tên đăng nhập
                    $sql = "SELECT * FROM taikhoan WHERE tendangnhap = '$username'";
                    $rows = mysqli_query($conn, $sql);
                    if (!$rows) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    $count = mysqli_num_rows($rows);
                    if($count > 0) {
                        $error = "Tên đăng nhập đã tồn tại!";
                    }

                    // Kiểm tra số điện thoại
                    $check = true;
                    $so_dau = $phonenumber[0].$phonenumber[1].$phonenumber[2];

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
                            $error = "Số điện thoại không hợp lệ!";
                            break;
                        }
                    }

                    for($i = 0 ; $i < strlen($phonenumber) ; ++$i) {
                        if($phonenumber[$i] == "0" || $phonenumber[$i] == "1" || $phonenumber[$i] == "2" || $phonenumber[$i] == "3" || $phonenumber[$i] == "4" || $phonenumber[$i] == "5" || $phonenumber[$i] == "6" || $phonenumber[$i] == "7" || $phonenumber[$i] == "8" || $phonenumber[$i] == "9") {
                            continue;
                        }
                        $check = false;
                        break;
                    }
                    if($check == false) {
                        $error = "Số điện thoại không hợp lệ!";
                    }

                    // Chốt hạ
                    if($error == "") {
                        $sql = "INSERT INTO taikhoan (tendangnhap, matkhau, hoten, sdt, email) VALUES ('$username', '$password', '$fullname', '$phonenumber', '$email')";
                        mysqli_query($conn, $sql);

                        sleep(2);

                        header("location:dangnhap.php");
                    } else {
                        echo '<div class="error">';
                            echo $error;
                            echo '<i onclick="deleteError("error);" class="fa-solid fa-x icon"></i>';
                        echo '</div>';
                    }
                }
            ?>

            <!-- Javascript nhà làm -->
            <script src="./javascript/main_taotaikhoan.js"></script>
        </body>
    </html>