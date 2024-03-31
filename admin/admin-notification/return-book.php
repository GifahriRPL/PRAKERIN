<?php
    include '../../functions.php';
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
      header("Location: ../../login.php");
    }
       
  
    $id_user = mysqli_real_escape_string($conn, $_GET["id"]);
    $id_buku = mysqli_real_escape_string($conn, $_GET["id_buku"]);

    $data = query("SELECT jumlah_buku FROM tb_buku WHERE id = $id_buku")[0];
    $jumlahbuku = $data["jumlah_buku"]+1;


    mysqli_query($conn, "UPDATE tb_buku SET jumlah_buku = '$jumlahbuku' WHERE id = $id_buku");
    mysqli_query($conn, "DELETE FROM user_active WHERE id_get_anggota = $id_user AND id_buku = $id_buku");


    echo "<script>
    window.location = '../index.php';
    </script>";
    
?>