<?php
include './connexion.php';

$user_id = $_SESSION['user_id'] && $_SESSION['role'] !== 'admin' ? $_SESSION['user_id'] : null;
$client_id_as_string = $_SESSION['user_id'] && $_SESSION['role'] !== 'admin' ? $_SESSION['user_id'] : 'null';

$pdostat = $connexion->prepare("SELECT planningscommandeclients.* , users.prenom, users.nom, plat.nomPlat
                                    FROM `planningscommandeclients` 
                                    JOIN users on users.id = planningscommandeclients.idClient
                                    JOIN plat on plat.Id = planningscommandeclients.id_plat
                                    WHERE 'null' = :client_id_as_string OR users.id = :client_id"
                                    );
$pdostat->bindValue(':client_id', $user_id ,PDO::PARAM_INT) ;
$pdostat->bindValue(':client_id_as_string', $client_id_as_string ,PDO::PARAM_STR) ;
$executeisOk = $pdostat->execute();
$plannings = $pdostat->fetchAll();
?>

<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            
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
                            <th class="text-nowrap">ID</th>
                            <th class="text-nowrap">client name</th> 
                            <th class="text-nowrap">Plat name</th>
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
                                <td><?= $planning['id'] ?></td>
                                <td><?= $planning['prenom'] . ' ' . $planning['nom'] ?></td>
                                <td><?= $planning['nomPlat'] ?></td>
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