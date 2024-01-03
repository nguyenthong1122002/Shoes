<?php
    session_start();
    $_SESSION["login"] = "false";
    $_SESSION["id_account"] = "";
    $_SESSION["username"] = "";
    $_SESSION["password"] = "";
    $_SESSION["fullname"] = "";
    $_SESSION["phonenumber"] = "";
    $_SESSION["email"] = "";
    $_SESSION["avatar"] = "";
    $_SESSION["address"] = "";
    $_SESSION["notice_thongtintaikhoan"] = "";
    $_SESSION["success_or_error_notice_thongtintaikhoan"] = true;

    if(isset($_GET["linkpage"])) {
        $linkpage = $_GET["linkpage"];
        header("location:$linkpage.php");
    } else {
        header("location:trangchu.php");
    }
?>