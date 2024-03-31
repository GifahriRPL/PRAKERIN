<?php
    include '../functions.php';
    if(!isset($_SESSION["user"]) && !isset($_SESSION["login"])){
        header("Location: ../login.php");
      }
      
    $username = $_SESSION['user'];
    $buku = mysqli_real_escape_string($conn,$_GET['buku']);
    
    mysqli_query($conn, "DELETE FROM list WHERE username = '$username' AND judul = '$buku'");

    echo "
        <script>
            window.location = 'index.php';
        </script>
    ";


?>