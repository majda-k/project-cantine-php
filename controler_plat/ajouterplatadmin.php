<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    include "../connexion.php";

    $id = $_POST['id'] ?? null;
    $imagePlat = $_POST['imagePlat'] ?? null;
    $nomPlat = $_POST['nomPlat'] ?? null;
    $prixPlat = $_POST['prixPlat'] ?? null;
    $descriptionPlat = $_POST['descriptionPlat'] ?? null;

    if ($imagePlat && $nomPlat && $prixPlat && $descriptionPlat) {
        if ($id) {
            $pdostat = $connexion->prepare('UPDATE plat SET imagePlat = :imagePlat, nomPlat = :nomPlat, prixPlat = :prixPlat, descriptionPlat = :descriptionPlat WHERE Id = :id');
            $pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        } else {
            $pdostat = $connexion->prepare('INSERT INTO plat (imagePlat, nomPlat, prixPlat, descriptionPlat) VALUES (:imagePlat, :nomPlat, :prixPlat, :descriptionPlat)');
        }

        $pdostat->bindValue(':imagePlat', $imagePlat, PDO::PARAM_STR);
        $pdostat->bindValue(':nomPlat', $nomPlat, PDO::PARAM_STR);
        $pdostat->bindValue(':prixPlat', $prixPlat, PDO::PARAM_INT);
        $pdostat->bindValue(':descriptionPlat', $descriptionPlat, PDO::PARAM_STR);

        $insertisOk = $pdostat->execute();

        if ($insertisOk) {
            header('Location: ../in_plat.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Échec de l'ajout ou de la modification du plat !</div>";
        }
    }
} elseif (isset($_POST['action'])) {
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

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Admin' ?></h2>
        </div>
    </div>

    <!-- Form Section -->
    <form action="/project-cantine-php/controler_plat/ajouterplatadmin.php" method="POST">
        <div class="mb-3">
            <input type="hidden" name="id" value="<?= $platedit['Id'] ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="imagePlat" class="form-label fw-bold">Image Plat URL</label>
            <input type="text" id="imagePlat" name="imagePlat" class="form-control" value="<?= $platedit['imagePlat'] ?? ''; ?>" placeholder="URL de l'image" required>
        </div>
        <div class="mb-3">
            <label for="nomPlat" class="form-label fw-bold">Nom du Plat</label>
            <input type="text" id="nomPlat" name="nomPlat" class="form-control" value="<?= $platedit['nomPlat'] ?? ''; ?>" placeholder="Nom du plat" required>
        </div>
        <div class="mb-3">
            <label for="prixPlat" class="form-label fw-bold">Prix du Plat</label>
            <input type="number" id="prixPlat" name="prixPlat" class="form-control" value="<?= $platedit['prixPlat'] ?? ''; ?>" placeholder="Prix du plat" required>
        </div>
        <div class="mb-3">
            <label for="descriptionPlat" class="form-label fw-bold">Description</label>
            <textarea id="descriptionPlat" name="descriptionPlat" class="form-control" rows="3" placeholder="Description du plat" required><?= $platedit['descriptionPlat'] ?? ''; ?></textarea>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <?= isset($platedit) ? 'Enregistrer les modifications' : 'Créer'; ?>
            </button>
            <button type="button" class="btn btn-danger" onclick="window.history.back()">Annuler</button>
        </div>
    </form>
</div>

<?php
} else {
    echo "<div class='alert alert-warning'>Cette méthode n'est pas encore supportée.</div>";
}
?>
