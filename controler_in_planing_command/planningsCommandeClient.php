<?php
include './connexion.php';

$user_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : null;
$pdostat = $connexion->prepare('SELECT * FROM planningscommandeclients WHERE idClient = :id ');
$pdostat->bindValue(':id', $user_id ,PDO::PARAM_INT) ;

$executeisOk = $pdostat->execute();
$plannings = $pdostat->fetchAll();
?>

<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Client' ?></h2>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Create Planning Button -->
            <div class="d-flex justify-content-end mb-4">
                <form action="in_planing_command.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <button class="btn btn-primary"
                            type="submit"
                            name="action"
                            value="openCreateForm">
                        Créer votre planning de commande
                    </button>
                </form>
            </div>

            <!-- Planning Table -->
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle w-auto mx-auto">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">Plat</th>
                            <th class="text-nowrap">Quantité</th>
                            <th class="text-nowrap">Jour Commande</th>
                            <th class="text-nowrap">Heure</th>
                            <th class="text-nowrap">Prix</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($plannings as $planning): ?>
                            <tr>
                                <td><?= $planning['plat'] ?></td>
                                <td><?= $planning['quantite'] ?></td>
                                <td><?= $planning['jourCommande'] ?></td>
                                <td><?= $planning['heure'] ?></td>
                                <td><?= $planning['prix'] ?></td>
                                <td>
                                    <span class="badge <?= $planning['status'] === 'En attente' ? 'bg-warning' : 
                                        ($planning['status'] === 'Confirmé' ? 'bg-success' : 
                                        ($planning['status'] === 'Annulé' ? 'bg-danger' : 'bg-secondary')) ?>">
                                        <?= $planning['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="in_planing_command.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $planning['id'] ?>">
                                            <button type="submit" name="action" value="modifier" class="btn btn-sm btn-primary">Modifier</button>
                                        </form>
                                        <form action="in_planing_command.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $planning['id'] ?>">
                                            <button type="submit" name="action" value="supprimer" class="btn btn-sm btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>