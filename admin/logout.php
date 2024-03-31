<?php
    session_start();
    session_destroy();
    session_commit();

    // header("Location: login.php");
    $_SESSION["login"] = false;
    if(isset($_SESSION["login"])){
        header("Location: ../login.php");
        exit;
    }


?>