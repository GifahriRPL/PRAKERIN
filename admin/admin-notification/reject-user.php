<?php
    include '../../functions.php';
    //Cek Aapakah Sudah Login
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
      header("Location: ../../login.php");
    }
       

  
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    // $path = "track-book-user.php?id".

    mysqli_query($conn, "DELETE FROM list WHERE id = $id");

    echo "<script>
    window.location = '../index.php';
    </script>";
?>