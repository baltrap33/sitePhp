<?php
$identifiant = (isset($_POST['identifiant'])   && !empty($_POST['identifiant']) )? $_POST['identifiant']:'';
$password = (isset($_POST['password'])   && !empty($_POST['password']) )? $_POST['password']:'';
$deconnexion = (isset($_GET['deconnexion'])   && !empty($_GET['deconnexion']) )? $_GET['deconnexion']:null;

if($deconnexion == true && $_SESSION['isConnected'] === true ){
    session_destroy();
    header('Location: /index.php');
}
if( $identifiant === 'admin' && $password === 'admin' ){
    if ($_SESSION['isConnected'] !== true) {
        session_start([
            'cookie_lifetime' => 86400,
        ]);
        $_SESSION['user'] = $identifiant;
        $_SESSION['isConnected'] = true;
        $_SESSION['timeStamp'] = time();
        header('Location: /admin.php');
        exit;
    }

}

if ( isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ) {
    header('Location: /index.php');
}
?>
<header class="container-fluid">
    <div class="row connexion">
        <div class="col-12 col-sm-8">
            <div class="row card border-warning bg-white">
                <?php
                if (    ($identifiant && $identifiant !== 'admin') ||
                    ($password && $password !== 'admin') ){ ?>
                    <div class="col alert alert-danger">
                        Le couple identifiant / mot de passe n'existe pas.
                    </div>
                <?php
                }
                ?>
                <form class="col mb-3" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Identifiant</label>
                        <input name="identifiant" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email ou identifiant">
                        <small id="emailHelp" class="form-text text-muted">Nous ne diffusons pas votre email aux des tiers.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mot de passe</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
                    </div>

                    <button type="submit" class="btn btn-warning">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</header>
<?php createSeparator(); ?>