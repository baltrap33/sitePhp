<?php
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

function createContent($page){
    include "content/content_$page.php";
}