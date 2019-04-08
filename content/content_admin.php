<header class="container-fluid">
    <div class="row connexion">
        <div class="col-12 col-sm-8">
            <div class="row card border-warning bg-white">
                <div class="col">Bienvenue <?= $_SESSION['userUsername']; ?> !</div>
                <div class="col">Dans votre espace client.</div>
                <div class="col">Votre email est <?= $_SESSION["userEmail"] ?> .</div>
            </div>
        </div>
    </div>
</header>
<?php createSeparator(); ?>