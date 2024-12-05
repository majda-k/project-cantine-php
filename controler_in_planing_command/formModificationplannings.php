<?php
if (isset($_POST['action'])) {
    $planningscommande = null;
    if (isset($_POST['id'])) {
        $id = $_POST["id"];
        $pdostat = $connexion->prepare('SELECT * FROM planningscommandeclients WHERE  id =:id');

        $pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $executeisOk = $pdostat->execute();

        $planningscommande = $pdostat->fetch();
    }
}

?>

<div class="dashbord-content12 flex flex-column">
    <!-- debut header -->
    <div class="header">
        <h2 class="ml1">Bonjour Majda</h2>
    </div>
    <!-- fin header -->
    <div class="content6 flex justify-center mb3 ">
        <div class="plannings flex flex-column mt3">
            <h3 class="ml3 mt3 ">Modifier votre Plannings commande</h3>
            <div class="pln-cmd flex flex-column mb4">
                <form action="./controler_in_planing_command/modifierplannings.php" method='POST'>

                    <input type="hidden" name="id" value="<?= $planningscommande['id'] ?>">
                    <div class="plat flex justify-between gap-medium mb3">
                        <span>Plat</span>
                        <input type="text" name="plat" value="<?= $planningscommande['plat'] ?>">
                    </div>
                    <div class="Qte flex justify-between gap-medium mb3">
                        <span>Quantite</span>
                        <input type="text" name="quantite" value="<?= $planningscommande['quantite'] ?>">
                    </div>
                    <div class="jourCommande flex  justify-between gap-medium mb3 ">
                        <span>Jour de Commande</span>

                        <?php $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                        $joursSelectionnes = explode(',', $planningscommande['jourCommande']);
                        foreach ($jours as $jour) {
                            $checked = in_array($jour, $joursSelectionnes) ? 'checked' : '';
                            echo "<label><input type='checkbox' name='jourCommande[]' value='$jour' $checked> $jour</label><br>";
                        } ?>
                    </div>
                    <div class="heure flex justify-between gap-medium mb3">
                        <span>L'Heure</span>
                        <input type="text" name="heure" value="<?= $planningscommande['heure'] ?>">
                    </div>
                    <div class="Prix flex justify-between gap-medium mb3">
                        <span>Prix d'une Commande</span>
                        <input type="text" name="prix" value="<?= $planningscommande['prix'] ?>">
                    </div>
                    <div class="button-pln-cmd flex justify-between">

                        <button type="submit" class="button-success">Enregistrer les modifications</button>

                </form>
                <button type="reset" class="button-danger">Annuler</button>
            </div>

        </div>
    </div>
</div>