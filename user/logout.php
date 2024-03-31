<?php
    session_start();
    session_destroy();
    session_commit();

    // header("Location: login.php");
     $_SESSION["login"] = false;
    if($_SESSION["login"] == false){
        header("Location: ../login.php");
        exit;
    }


?>