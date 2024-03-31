<?php
    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["login"])){
        header("Location: ../login.php");
      }
  
    // melakukan koneksi 
    $connect = mysqli_connect('localhost', 'root', '', 'db_perpustakaan');
    $user = $_SESSION['user'];

    //menghitung jumlah pesan dari tabel pesan
    $query1= mysqli_query($connect, "Select Count(id) as id1 From user_active WHERE username = '$user'");
    $query2= mysqli_query($connect, "Select Count(id) as id2 From list WHERE username = '$user'");
    
    //menampilkan data
    $hasil1 = mysqli_fetch_array($query1);
    $hasil2 = mysqli_fetch_array($query2);
    $hasil = $hasil1['id1'] + $hasil2['id2'];
    
    //membuat data json
    echo json_encode(array('jumlah' => $hasil));
    
?>