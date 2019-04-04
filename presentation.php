<?php
session_name("LeBarbierMobile");
    session_start();
    $page = "presentation";
    require "./requires/functions.php";
    include "./includes/head.php";
    createHeader($page);
    createContent($page);
    include "./includes/footer.php";