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
    include './connexion.php';
    $pdostat = $connexion->prepare('SELECT * FROM plat');
    $executeisOk = $pdostat->execute();
    $plats = $pdostat->fetchAll();
}

?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <h3 class="card-title mb-4">Modifier votre Plannings commande</h3>
                    <form id="planningsForm" action="./controler_in_planing_command/modifierplannings.php" method='POST'>
                        
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">planning id</label>
                            <div class="col-sm-8">
                                <input class="form-control" disabled value="<?= $planningscommande['id'] ?>">
                                <input type="hidden" name="id" data-original="<?= $planningscommande['id'] ?>" value="<?= $planningscommande['id'] ?>">

                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">cleint id</label>
                            <div class="col-sm-8">
                                <input class="form-control" disabled value="<?= $planningscommande['idClient'] ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Plat</label>
                            <div class="col-sm-8">
                                <select name="plat" id="plat"  class="form-select" aria-label="Default select example>
                                    <option value="choisissez un plat">Choisissez un plat</option>
                                    <?php foreach ($plats as $plat) : ?>

                                        <option value="<?php echo $plat['Id'] ?>">
                                            <?php echo $plat['nomPlat']; ?></option>
                                    <?php endforeach; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Quantite</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="quantite" data-original="<?= $planningscommande['quantite'] ?>" value="<?= $planningscommande['quantite'] ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="col-sm-4 col-form-label">Jour de Commande</label>
                            <div class="row row-cols-2 row-cols-md-3 g-3 " style="padding-left: 35%;">
                                <?php
                                $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                                $joursSelectionnes = explode(',', $planningscommande['jourCommande']);
                                foreach ($jours as $jour) {
                                    $checked = in_array($jour, $joursSelectionnes) ? 'checked' : '';
                                    $dataOriginal = in_array($jour, $joursSelectionnes) ? 'true' : 'false';
                                    echo "<div class='col'>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox' name='jourCommande[]' data-original='$dataOriginal' value='$jour' $checked id='$jour'>
                                                <label class='form-check-label' for='$jour'>" . ucfirst($jour) . "</label>
                                            </div>
                                        </div>";
                                } ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">L'Heure</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="heure" data-original="<?= $planningscommande['heure'] ?>" value="<?= $planningscommande['heure'] ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Prix d'une Commande</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="prix" data-original="<?= $planningscommande['prix'] ?>" value="<?= $planningscommande['prix'] ?>">
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Réinitialiser</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back()">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function resetForm() {
        const form = document.getElementById('planningsForm');
        const inputs = form.getElementsByTagName('input');

        for (let input of inputs) {
            if (input.type === 'checkbox') {
                input.checked = input.getAttribute('data-original') === 'true';
            } else {
                const originalValue = input.getAttribute('data-original');
                if (originalValue) {
                    input.value = originalValue;
                }
            }
        }
    }
</script>