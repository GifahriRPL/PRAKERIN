<?php 
    include '../../functions.php';

    if(!isset($_SESSION["user"]) && !isset($_SESSION["login"])){
     header("Location: ../login.php");
   }
   
    $username = $_SESSION["user"];
    $data_user = query("SELECT * FROM user_active WHERE username = '$username'");
     foreach($data_user as $row){
        $judul = $row["judul"];
        $date = $row["jatuh_tempo"];

       $data = " <div class='alert alert-success' role='alert'>
                     <p>Anda Sedang Meminjam Buku $judul;</p>
                     <p>Wajib Di Kembalikan Sebelum $date;</p>
                </div>";
      
      echo $data;
          
     }
     

?>