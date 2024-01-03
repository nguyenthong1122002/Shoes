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

    if(isset($_POST['buttonChangePassword'])) {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $verifyNewPassword = $_POST['verifyNewPassword'];

        if($oldPassword == "") {
            $_SESSION['notice_thongtintaikhoan'] = 'Ô nhập mật khẩu hiện tại không được để trống!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else if($newPassword == "") {
            $_SESSION['notice_thongtintaikhoan'] = 'Ô nhập mật khẫu mới không được để trống!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else if($verifyNewPassword == "") {
            $_SESSION['notice_thongtintaikhoan'] = 'Ô nhập xác nhận mật khẩu mới không được để trống!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else if($oldPassword != $_SESSION['password']) {
            $_SESSION['notice_thongtintaikhoan'] = 'Mật khẩu cũ không chính xác!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else if($oldPassword == $newPassword) {
            $_SESSION['notice_thongtintaikhoan'] = 'Mật khẩu mới không được trùng với mật khẩu cũ!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else if(strlen($newPassword) < 8) {
            $_SESSION['notice_thongtintaikhoan'] = 'Mật khẩu phải chứa ít nhất 8 kí tự!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else if($newPassword != $verifyNewPassword) {
            $_SESSION['notice_thongtintaikhoan'] = 'Xác nhận mật khẩu mới không chính xác!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = false;
            // header("location:doimatkhau.php");
        } else {
            $id_account = $_SESSION['id_account'];
            $sql = "UPDATE taikhoan SET matkhau = '$newPassword' WHERE id_taikhoan = $id_account";
            $result = mysqli_query($conn, $sql);
            $_SESSION['notice_thongtintaikhoan'] = 'Đổi mật khẩu thành công!';
            $_SESSION['success_or_error_notice_thongtintaikhoan'] = true;
        }

        header("location:doimatkhau.php");
    }
?>