<?php
    session_name("LeBarbierMobile");
    session_start();
    if($_SESSION['isConnected'] !== true ){
        header('Location: /connexion.php');
        exit;
    }
    require "./requires/functions.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $added = false;
        $add = (isset($_POST['add']) && !empty($_POST['add'])) ? $_POST['add'] : null;
        switch($add){
            case 'prestation':
                $titre = (isset($_POST['titre']) && !empty($_POST['titre'])) ? $_POST['titre'] : null;
                $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : null;
                $prix = (isset($_POST['prix']) && !empty($_POST['prix'])) ? $_POST['prix'] : null;
                $added = addPrestationContent($titre, trim($description), $prix);
                if ($added){
                    header("Location: /prestations.php");
                    exit();
                }
                break;
        }

    }

    header("Location: /admin.php");