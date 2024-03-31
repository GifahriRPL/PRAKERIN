<?php
    include '../../functions.php';
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
      header("Location: ../login.php");
    }


    $id_user = mysqli_real_escape_string($conn, $_GET["id"]);
    $date = date("l, d-m-Y");
    $jatuh_tempo = date("l, d-m-Y", strtotime($date.'+3 days'));


    $query = query("SELECT * FROM list WHERE list.id_get_anggota = $id_user")[0];
    $username = $query["username"];
    $id_buku = $query["id_get_buku"];
    $judul_buku = $query["judul"];
    $baru = query("SELECT jumlah_buku FROM tb_buku WHERE id = $id_buku")[0];
    $jumlahBuku = $baru["jumlah_buku"] - 1;


    mysqli_query($conn, "UPDATE tb_buku SET jumlah_buku = '$jumlahBuku' WHERE id = '$id_buku'");
    mysqli_query($conn, "INSERT INTO user_active VALUES('','$username','$judul_buku','$id_buku', '$id_user', '$date', '$jatuh_tempo')");
    mysqli_query($conn, "DELETE FROM list WHERE judul = '$judul_buku' AND id_get_anggota = $id_user");

    
    echo "<script>
    window.location = '../index.php';
    </script>";

?>