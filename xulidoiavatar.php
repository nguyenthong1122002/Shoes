<?php
    ob_start();
    session_start();

    $dbHost = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "dbmot"; // Add the database name here

    $conn = mysqli_connect($dbHost, $userName, $password, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "UTF8");
    var_dump($_FILES);

    $width = $_POST['width'];
    $height = $_POST['height'];
    $left = $_POST['left'];
    $top = $_POST['top'];

    // Chuyển avatar vào thư mục "avatar"
    move_uploaded_file($_FILES['buttonChangeAvatar']['tmp_name'], './avatar/'.$_FILES['buttonChangeAvatar']['name']);

    // Đưa tên file hình ảnh lên trên database
    $id_account = $_SESSION['id_account'];
    $nameFile = $_FILES['buttonChangeAvatar']['name'];

    $sql = "UPDATE taikhoan SET avatar = '$nameFile' WHERE id_taikhoan = $id_account";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM thongso_avatar WHERE id_taikhoan = $id_account";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count == 1) {
        $sql = "UPDATE thongso_avatar SET chieurong_goc = $width, chieudai_goc = $height, trai_goc = $left, tren_goc = $top WHERE id_taikhoan = $id_account";
        $result = mysqli_query($conn, $sql); 
    } else {
        $sql = "INSERT INTO thongso_avatar(id_taikhoan, chieurong_goc, chieudai_goc, trai_goc, tren_goc) VALUES ($id_account, $width, $height, $left, $top)";
        $result = mysqli_query($conn, $sql);
    }

    $_SESSION['avatar'] = $nameFile;

    header("location:thongtintaikhoan.php");

?>  