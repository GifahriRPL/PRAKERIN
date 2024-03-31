<?php
    include '../../functions.php';
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["login"])){
        header("Location: ../../login.php");
      }
         

if(isset($_POST['output'])){
    $output = $_POST['output'];


    if($output === '1'){
    var_dump($_POST['output']);
        mysqli_query($conn, "UPDATE admin_settings SET sett2 = '1' WHERE id = 1");
        echo "nyala";

    }elseif($output === '0'){
    var_dump($_POST['output']);
        mysqli_query($conn, "UPDATE admin_settings SET sett2 = '0' WHERE id = 1"); 
        echo "mati";

    }
}
?>
 