<header class="container-fluid">
    <div class="row presentation">
        <div class="titles ml-5 mr-5 mb-3">
            <div class="site">Le Barbier Mobile</div>
            <div class="phrase">Si la sagesse se mesurait par la longueur de la barbe, les boucs seraient philosophes !</div>
        </div>
    </div>
</header>
<?php createSeparator(); ?>
<div class="container" style="font-size:2.5rem">
    <div class="row mt-5">
        <div class="col-12 text-center">Nos Prestations
            <?php if ( isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ) {?>
                <a href="/admin.php?add=prestation">
                    <button class="btn btn-sm btn-primary float-right">
                        <i class="material-icons">add</i>
                    </button>
                </a>
            <?php }?>
        </div>
    </div>
    <?php
    $prestations = getAllPrestations();
    if (count($prestations) == 0){
        ?>
        <div class="prestation-row mt-5 mb-5">
            Aucune prestation disponible
        </div>
        <?php
    }
    foreach($prestations as $prestation ) {
        ?>
        <div class="prestation-row mt-5 mb-5">
            <hr style="border-color: #ffc107;">
            <div class="row mt-5">
                <div class="col-12 col-md-3 text-center mb-3">
                    <img class="img-fluid" src="../assets/img/beard.png"/>
                </div>
                <div class="col-9 col-md-6 col-lg-7">
                    <div class="row">
                        <h1 class="col-12"><?= ucfirst($prestation["titre"])?></h1>
                    </div>
                    <div class="row">
                        <div class="col-12"><?= $prestation["description"]?></div>
                    </div>
                </div>
                <div class="col-3 col-md-2 col-lg-2 text-right">
                    <?= $prestation["prix"]?>€
                </div>
                <?php if ( isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true ) {?>
                    <div class="modif-row">
                        <a href="/admin.php?edit=prestation&id=<?= $prestation["id"]; ?>">
                            <button class="btn btn-sm btn-primary">

                                <i class="material-icons">edit</i>
                            </button>
                        </a>
                        <form class="ml-2" method="post" action="/delete.php">
                            <input type="hidden" name="delete" value="prestation" />
                            <input type="hidden" name="id" value="<?= $prestation["id"]; ?>" />
                            <button class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                        </form>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php
    }
    ?>

</div>
