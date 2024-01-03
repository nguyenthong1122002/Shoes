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

    $idAccount = $_GET['idaccount'];
    $idGiay = $_GET['idgiay'];
    $idSize = $_GET['idsize'];

    $sql = "DELETE FROM giohang WHERE id_taikhoan = $idAccount AND id_giay = $idGiay AND id_size = $idSize";
    $result = mysqli_query($conn, $sql);

    header("location:giohang.php");
?>