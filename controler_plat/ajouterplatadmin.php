<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    include "../connexion.php";

    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $imagePlat = isset($_POST['imagePlat']) ? $_POST['imagePlat'] : null;
    $nomPlat = isset($_POST['nomPlat']) ? $_POST['nomPlat'] : null;
    $prixPlat = isset($_POST['prixPlat']) ? $_POST['prixPlat'] : null;
    $descriptionPlat = isset($_POST['descriptionPlat']) ? $_POST['descriptionPlat'] : null;


    if ($imagePlat && $nomPlat && $prixPlat && $descriptionPlat) {

        if ($id) {
            $pdostat = $connexion->prepare('UPDATE plat SET imagePlat = :imagePlat , nomPlat=:nomPlat , prixPlat=:prixPlat , descriptionPlat=:descriptionPlat WHERE Id = :id');
            $pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        } else {
            $pdostat = $connexion->prepare('INSERT INTO plat(imagePlat ,nomPlat, prixPlat ,descriptionPlat) VALUES(:imagePlat ,:nomPlat, :prixPlat , :descriptionPlat )');
        }

        $pdostat->bindValue(':imagePlat', $imagePlat, PDO::PARAM_STR);
        $pdostat->bindValue(':nomPlat', $nomPlat, PDO::PARAM_STR);
        $pdostat->bindValue(':prixPlat', $prixPlat, PDO::PARAM_INT);
        $pdostat->bindValue(':descriptionPlat', $descriptionPlat, PDO::PARAM_STR);

        $insertisOk = $pdostat->execute();

        if ($insertisOk) {
            header('location: ../in_plat.php');
            exit();
        } else {
            echo "echec d'ajouter le plat !!!";
        }
    }
} else if (isset($_POST['action'])) {
    include "./connexion.php";
    $platedit = null;
    if (isset($_POST['id'])) {
        $id = $_POST["id"];
        $pdostat = $connexion->prepare("SELECT * FROM plat WHERE Id = :id");
        $pdostat->bindParam(':id', $id);
        $pdostat->execute();
        $platedit = $pdostat->fetch();
    }
?>

    <div class="dashbord-content12 flex flex-column">
        <!-- debut header -->
        <div class="header">
            <h2 class="ml1">Bonjour Majda</h2>
        </div>
        <!-- fin header -->
        <div class="content12">
            <form action="/project-cantine-php/controler_plat/ajouterplatadmin.php" method="POST">
                <div class="info-ajouter flex  ">
                    <div class="nom flex justify-between p3">

                        <input type="hidden" name="id" value="<?php if (isset($platedit)) echo $platedit["Id"];
                                                                else echo "";  ?>" placeholder="id" />
                    </div>
                    <div class="nom flex justify-between p3">
                        <span class="f-w-b">Image Plat Url : </span>
                        <input type="text" name="imagePlat" value="<?php if (isset($platedit)) echo $platedit["imagePlat"];
                                                                    else echo "";  ?>" placeholder="URL de l'image" required />
                    </div>
                    <div class="nom flex justify-between p3">
                        <span class="f-w-b">Nom du plat : </span>
                        <input type="text" name="nomPlat" value="<?php if (isset($platedit)) echo $platedit["nomPlat"];
                                                                    else echo "";  ?>" placeholder="Nom du plat" required />
                    </div>
                    <div class="prix flex justify-between p3 ">
                        <span class="f-w-b">Prix du plat : </span>
                        <input type="number" name="prixPlat" value="<?php if (isset($platedit)) echo $platedit["prixPlat"];
                                                                    else echo "";  ?>" placeholder="prix de plat" required />
                    </div>
                    <div class="nom flex justify-between p3">
                        <span class="f-w-b">Description : </span>
                        <input name="descriptionPlat" type="text" value="<?php if (isset($platedit)) echo $platedit["descriptionPlat"];
                                                                            else echo "";  ?>" placeholder="description du plat" required />
                    </div>
                    <div class="button-plat flex justify-between p4">
                        <?php if (isset($platedit)) { ?>
                            <button type="submit" class="button-success">Enregistrer les modifications</button>
                        <?php
                        } else { ?>
                            <button type="submit" class="button-success">Creer</button>
                        <?php } ?>
            </form>
            <form action="" method="post">
                <button type="button" class="button-danger" onclick="window.history.back()">Annuler</button>
            </form>
        </div>
    </div>
    </div>
    </div>
<?php

} else {
    echo "this method not suported yet";
}


?>