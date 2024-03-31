<?php
    include '../../functions.php';
    
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
        header("Location: ../../login.php");
      }
         

if(isset($_POST['sett3'])){
    $sett3 = $_POST['sett3'];


    if($sett3 === '1'){
    var_dump($_POST['sett3']);
        mysqli_query($conn, "UPDATE admin_settings SET sett3 = '1' WHERE id = 1");
        echo "otomatis";

    }elseif($sett3 === '0'){
    var_dump($_POST['sett3']);
        mysqli_query($conn, "UPDATE admin_settings SET sett3 = '0' WHERE id = 1"); 
        echo "manual";

    }
}
?>