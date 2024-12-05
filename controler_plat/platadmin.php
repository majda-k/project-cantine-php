<?php

include './connexion.php' ;
$pdostat = $connexion->prepare('SELECT * FROM plat');
$executeisOk = $pdostat->execute();
$plats = $pdostat->fetchAll();

?>


<div class="dashbord-content12 flex flex-column">
    <!-- debut header -->
    <div class="header">
        <h2 class="ml1">Bonjour Majda</h2>
    </div>
    <!-- fin header -->
    <div class="content12 flex flex-column">
        <div class="filter flex flex-row justify-between py4">
            <div class="filter-info">

                <form action="/project-cantine-php/in_plat.php" method="post">
                    <button
                        type="submit"
                        name="action"
                        value="add"
                        class="ml2 button-success t-center">Ajouter un nouveau plat</button>
                </form>


            </div>
            <div class="category flex flex-row">
                <input
                    type="text"
                    name="categories"
                    value="Categories"
                    class="ml2" />
                <input
                    type="text"
                    name="Chercher"
                    value="Chercher"
                    class="mr6" />
            </div>
        </div>
        <div class="plats-page flex justify-center">
            <?php foreach ($plats as $plat):  ?>
                <div class="plat1 rad-10">
                    <div class="plat-img">
                        <img src="<?= $plat['imagePlat'] ?>" alt="" />
                    </div>
                    <div class="plats-info">
                        <div class="nom flex justify-between p1">
                            <span>Nom</span>
                            <span><?= $plat['nomPlat'] ?></span>
                        </div>
                        <div class="Prix flex justify-between p1">
                            <span>Prix</span>
                            <span><?= $plat['prixPlat'] ?>MAD</span>
                        </div>
                        <div class="Taux ml1 mr1 flex justify-between">
                            <span>description</span>
                            <span>
                                <?= $plat['descriptionPlat'] ?>
                            </span>
                        </div>
                        <div class="div flex justify-center">
                            <form action="in_plat.php" method="post">
                                <input type="hidden" name="id" value="<?= $plat['Id'] ?>" />
                                <button
                                    type="submit"
                                    name="action"
                                    value="details"
                                    class="button-danger ml1 mt3 t-center ">Lire Plus</button>
                            </form>
                            <form action="in_plat.php" method="post">
                                <input type="hidden" name="id" value="<?= $plat['Id'] ?>" />
                                <button
                                    type="submit"
                                    name="action"
                                    value="edit"
                                    class="button-success ml1 mt3 t-center ">Modifier</button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="pagination flex justify-end mr6">
        <i class="fa-solid fa-caret-left"></i>
        <span class="mr3 ml3">1</span>
        <span class="mr3">2</span>
        <span class="mr3">3</span>
        <i class="fa-solid fa-caret-right"></i>
    </div>
</div>