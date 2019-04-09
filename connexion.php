<?php
    session_name("LeBarbierMobile");
    session_start();




    $page = "connexion";
    require "./requires/functions.php";
    include "./includes/head.php";

    $identifiant = (isset($_POST['identifiant']) && !empty($_POST['identifiant'])) ? $_POST['identifiant'] : '';
    $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : '';
    $deconnexion = (isset($_GET['deconnexion']) && !empty($_GET['deconnexion'])) ? $_GET['deconnexion'] : null;

    if ($deconnexion == true && $_SESSION['isConnected'] === true) {
        session_destroy();
        header('Location: /index.php');
        exit;
    }

    $logged = user_login($identifiant, $password);
    if ($logged) {
        if ($_SESSION['isConnected'] !== true) {
            $_SESSION['isConnected'] = true;
            $_SESSION['timeStamp'] = time();
            header('Location: /admin.php');
            exit;
        }
    }

    if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true) {
        header('Location: /index.php');
    }

    createHeader($page);
    createContent($page, array("identifiant"=>$identifiant, "password"=>$password));
    include "./includes/footer.php";