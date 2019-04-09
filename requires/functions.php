<?php
require './config/DbPdo.php';

function createHeader($page){
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <a class="navbar-brand" href="#">
            <img src="../assets/img/beard.png" width="50" height="50" class="d-inline-block align-top mr-3" alt="">
            Le Barbier mobile
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $page === "accueil"? "active":""; ?>">
                    <a class="nav-link" href="accueil.php">Accueil </a>
                </li>
                <li class="nav-item <?= $page === "presentation"? "active":""; ?>">
                    <a class="nav-link" href="presentation.php">Presentation </a>
                </li>
                <li class="nav-item <?= $page === "news"? "active":""; ?>">
                    <a class="nav-link" href="news.php">News </a>
                </li>
                <li class="nav-item <?= $page === "prestations"? "active":""; ?>">
                    <a class="nav-link" href="prestations.php">Nos prestations </a>
                </li>
                <?php
                if ( isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ) {
                    ?>
                    <li class="nav-item <?= $page === "admin"? "active":""; ?>">
                        <a class="nav-link" href="admin.php">Admin </a>
                    </li>
                    <li class="nav-item <?= $page === "connexion"? "active":""; ?>">
                        <a class="nav-link" href="connexion.php?deconnexion=true">Deconnexion </a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="nav-item <?= $page === "connexion"? "active":""; ?>">
                        <a class="nav-link" href="connexion.php">Connexion </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
    <?php
}

function createSeparator(){
    ?>
    <div class="container-fluid">
        <div class="row separator bg-warning"></div>
    </div>
    <?php
}

function createContent($page, $params=null){
    if($params && is_array($params)){
        foreach ($params as $key=>$value){
            $$key = $value;
        }
    }

    include "content/content_$page.php";
}

function addContent($add){

    include "add/add_$add.php";
}

function editContent($edit, $id){
    $con = connexionDb();
    $query = $con->prepare("SELECT * FROM prestations WHERE id= :id");
    $query->execute(array(":id"=>$id));
    $$edit = $query->fetch(PDO::FETCH_ASSOC);
    include "edit/edit_$edit.php";
}

function addPrestationContent($titre, $description = null, $prix = 0){
    $con = connexionDb();
    $queryCreate = $con->prepare("INSERT INTO prestations (`id`,`titre`,`description`,`prix`, `imgPath`) VALUES(NULL, :titre, :description, :prix, NULL)");
    $result = $queryCreate->execute(array(
        ":titre"=>$titre,
        ":description"=>$description,
        ":prix"=>$prix
    ));
    return $result;
}
function savePrestationContent($id, $titre, $description = null, $prix = 0){
    $con = connexionDb();
    $queryUpdate = $con->prepare("UPDATE prestations 
                            SET `titre` = :titre,
                                `description` = :description,
                                `prix` = :prix
                            WHERE `id` = :id;");
    $resultUpdate = $queryUpdate->execute(array(
        ":titre"=>$titre,
        ":description"=>$description,
        ":prix"=>$prix,
        ":id"=>$id
    ));
    return $resultUpdate;
}

function deletePrestationContent($id){
    $con = connexionDb();
    $queryDelete = $con->prepare("DELETE FROM prestations WHERE `id` = :id;");
    $resultDelete = $queryDelete->execute(array(":id"=>$id));
    return $resultDelete;
}

function connexionDb(){
    return DbPDO::pdoConnexion();
}

function user_login($identifiant,$password){
    $con = connexionDb();
    $query = $con->prepare("SELECT * FROM `users` WHERE username= :identifiant and password= :password;");
    $query->execute(array(':identifiant' => $identifiant, ':password' => sha1($password)));
    $count = $query->rowCount();
    if($count == 1){
        session_start([
            'cookie_lifetime' => 86400,
        ]);
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION["userId"] = $row["id"];
            $_SESSION["userUsername"] = $row["username"];
            $_SESSION["userEmail"] = $row["email"];
        }
    }
    return $count == 1;
}

function getAllPrestations(){
    $con = connexionDb();
    $query = $con->prepare("SELECT * FROM prestations");
    $query->execute();
    $rows = [];
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        array_push($rows, $row);
    }
    return $rows;
}