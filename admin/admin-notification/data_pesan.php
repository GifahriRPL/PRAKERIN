<?php
    session_start();
    // melakukan koneksi 
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
      header("Location: ../../login.php");
    }
       

    $connect = mysqli_connect('localhost', 'root', '', 'db_perpustakaan');

    //mengambil data 5 pesan terbaru 
    $sql = mysqli_query($connect, "SELECT * FROM list ORDER BY id DESC");
    $result = array();
    
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    echo json_encode(array("result" => $data));
?>