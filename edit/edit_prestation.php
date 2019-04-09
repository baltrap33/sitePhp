<header class="container-fluid">
    <div class="row connexion" style="align-items: flex-start;">
        <div class="col-12 col-sm-4">
            <div class="row card border-warning bg-white">
                <div class="col-12 text-center"><img class="img-thumbnail" src="../assets/img/beard.png"/></div>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="row card border-warning bg-white">
                <h1 class="col-12 text-center">
                    Edition d'une prestation
                </h1>
                <form class="col mb-3" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="id" value="<?= $prestation["id"]?>"/>
                    <input type="hidden" name="edit" value="prestation"/>
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input name="titre" type="text" value="<?= $prestation["titre"]?>" class="form-control" id="titre">
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea name="description" class="form-control" id="description"
                                  placeholder="description de la prestation">
                            <?= $prestation["description"]?>
                        </textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="prix">Prix :</label>
                        <input name="prix" type="number" step="0.01" class="col-6 form-control" id="prix" value="<?= $prestation["prix"]?>" />
                    </div>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-warning">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</header>
<?php createSeparator(); ?>