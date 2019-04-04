<?php
    session_name("LeBarbierMobile");
    session_start();
    if($_SESSION['isConnected'] !== true ){
        header('Location: /login.php');
        exit;
    }
    $page = "admin";
    require "./requires/functions.php";
    include "./includes/head.php";
    createHeader($page);
    createContent($page);
    include "./includes/footer.php";