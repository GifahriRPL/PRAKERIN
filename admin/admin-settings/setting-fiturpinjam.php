<?php
    include '../../functions.php';
    
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
        header("Location: ../../login.php");
      }
         

if(isset($_POST['sett1'])){
    $sett1 = $_POST['sett1'];


    if($sett1 === '1'){
    var_dump($_POST['sett1']);
        mysqli_query($conn, "UPDATE admin_settings SET sett1 = '1' WHERE id = 1");
        echo "nyalaa";

    }elseif($sett1 === '0'){
    var_dump($_POST['sett1']);
        mysqli_query($conn, "UPDATE admin_settings SET sett1 = '0' WHERE id = 1"); 
        echo "matii";

    }
}
?>