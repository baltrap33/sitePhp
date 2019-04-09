<?php
    session_name("LeBarbierMobile");
    session_start();
    if($_SESSION['isConnected'] !== true ){
        header('Location: /connexion.php');
        exit;
    }
    require "./requires/functions.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $deleted = false;
        $delete = (isset($_POST['delete']) && !empty($_POST['delete'])) ? $_POST['delete'] : null;
        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : null;
        switch($delete){
            case 'prestation':
                $deleted = deletePrestationContent($id);
                if ($deleted){
                    header("Location: /prestations.php");
                    exit();
                }
                break;
        }

    }

    header("Location: /admin.php");