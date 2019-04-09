<?php
    session_name("LeBarbierMobile");
    session_start();
    if($_SESSION['isConnected'] !== true ){
        header('Location: /connexion.php');
        exit;
    }
    $page = "admin";
    require "./requires/functions.php";
    include "./includes/head.php";
    createHeader($page);
    $edit = (isset($_GET['edit']) && !empty($_GET['edit'])) ? $_GET['edit'] : null;
    $id = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : null;
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $saved = false;
        $edit = (isset($_POST['edit']) && !empty($_POST['edit'])) ? $_POST['edit'] : null;
        $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : null;
        switch($edit){
            case 'prestation':
                $titre = (isset($_POST['titre']) && !empty($_POST['titre'])) ? $_POST['titre'] : null;
                $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : null;
                $prix = (isset($_POST['prix']) && !empty($_POST['prix'])) ? $_POST['prix'] : null;
                $saved = savePrestationContent($id, $titre, $description, $prix);
                if ($saved){
                    header("Location: /prestations.php");
                    exit();
                }
                break;
        }

    }
    if ($edit && $id){
        editContent($edit, $id);
    }else{
        createContent($page);
    }
    include "./includes/footer.php";