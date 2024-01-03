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
    
    $id_account = $_GET['idaccount'];
    $id_giay = $_GET['idgiay'];
    $id_size = $_GET['idsize'];
    $soLuong = $_GET['soluong'];

    $sql = "UPDATE giohang SET soluong = $soLuong WHERE id_taikhoan = $id_account AND id_giay = $id_giay AND id_size = $id_size";
    $result = mysqli_query($conn, $sql);

    header("location:giohang.php");
?>