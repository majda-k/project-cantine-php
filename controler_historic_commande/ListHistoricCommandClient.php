<?php
include './connexion.php';
$pdostat = $connexion->prepare('SELECT * FROM commande WHERE idClient = :idClient');
$pdostat->bindValue(':idClient', $_SESSION['user_id'], PDO::PARAM_INT);
$executeisOk = $pdostat->execute();
$orders = $pdostat->fetchAll();

?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col">
            <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Client' ?></h2>
        </div>
    </div>
    <!-- fin header -->
    <div class="content5 d-flex justify-content-center">
        <div class="creation d-flex flex-column">

            <!-- generate Commandes Button -->
            <div class="d-flex justify-content-end">
                <form action="/project-cantine-php/in_historic_commande.php" method="POST">
                    <button type="submit" name="action" value="generate" class="btn btn-primary">generate Commandes</button>
                </form>
            </div>

            <!-- debut tableau -->
            <div class="table">
                <table class="table table-striped">
                    <thead>
                        <tr class="font-sm">

                            <th scope="col" class="font-weight-bold">Id planning</th>
                            <th scope="col" class="font-weight-bold">Id client</th>
                            <th scope="col" class="font-weight-bold">Plat</th>
                            <th scope="col" class="font-weight-bold">Quantite</th>
                            <th scope="col" class="font-weight-bold">Prix</th>
                            <th scope="col" class="font-weight-bold">Date de commande</th>
                            <th scope="col" class="font-weight-bold">Heure de commande</th>
                            <th scope="col" class="font-weight-bold">Statut</th>
                            <th scope="col" class="font-weight-bold">Creer en </th>

                            <?php if ($_SESSION['role'] == 'employee' || $_SESSION['role'] == 'admin'): ?>
                                <th scope="col" class="font-weight-bold">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr class="font-xs">
                                <th scope="row"><?= $order['id_planning'] ?></th>
                                <th scope="row"><?= $order['idClient'] ?></th>
                                <th scope="row"><?= $order['id_plat'] ?></th>
                                <th scope="row"><?= $order['quantite'] ?></th>
                                <th scope="row"><?= $order['prix'] ?></th>
                                <th scope="row"><?= $order['jourCommande'] ?></th>
                                <th scope="row"><?= $order['heure'] ?></th>
                                <th scope="row"><?= $order['status'] ?></th>
                                <th scope="row"><?= $order['creer_en'] ?></th>

                                <?php if ($_SESSION['role'] == 'employee' || $_SESSION['role'] == 'admin'): ?>
                                    <th scope="row" class="d-flex justify-content-around">
                                        <form action="/project-cantine-php/in_historic_commande.php" method="POST">
                                            <button type="submit" name="action" value="modifier" class="btn btn-primary mr-2">Edit</button>
                                        </form>
                                        <form action="/project-cantine-php/in_historic_commande.php" method="POST">
                                            <button type="submit" name="action" value="supprimer" class="btn btn-danger">Delete</button>
                                        </form>
                                    </th>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- fin tableau -->
        </div>
    </div>
</div>