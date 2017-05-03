<?php
    session_start();

    if(empty($_SESSION['ok1'])){
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
?>