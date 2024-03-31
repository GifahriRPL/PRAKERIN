<?php
    include '../../functions.php';
    
    if(!isset($_SESSION["user"]) && !isset($_SESSION["login"])){
        header("Location: ../login.php");
      }
      
    $username = $_SESSION['user'];
    
    $query = query("SELECT * FROM list WHERE username = '$username'");

    foreach($query as $row){

    $judul = $row['judul'];

    $data = "<div class='alert alert-danger' role='alert'>
    <p>$judul, Butuh persetujuan Admin</p>
    <a href='cencle.php?buku=$judul' type='button' class='btn btn-danger btn-sm' style='float:right;'>Cencle</a>
    </div>
    ";
    
        echo $data;
        
    }
?>