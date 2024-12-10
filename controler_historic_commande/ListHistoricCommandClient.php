<?php
// Define the data
$orders = [
    [
        'plat' => 'burger',
        'quantite' => 3,
        'prix' => '16 MAD',
        'date' => '09/09/2023',
        'heure' => '12h00',
        'statut' => 'En Cours de Preparation',
        'badge_class' => 'bg-secondary'
    ],
    [
        'plat' => 'burger',
        'quantite' => 3,
        'prix' => '16 MAD',
        'date' => '09/09/2023',
        'heure' => '12h00',
        'statut' => 'Commande Annuler',
        'badge_class' => 'bg-danger'
    ]
];
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
            <!-- debut tableau -->
            <div class="table mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr class="font-sm">
                            <th scope="col" class="font-weight-bold">Plat</th>
                            <th scope="col" class="font-weight-bold">Quantite</th>
                            <th scope="col" class="font-weight-bold">Prix</th>
                            <th scope="col" class="font-weight-bold">Date de commande</th>
                            <th scope="col" class="font-weight-bold">Heure de commande</th>
                            <th scope="col" class="font-weight-bold">Statut</th>
                           
                            <?php if ($_SESSION['role'] == 'employee' || $_SESSION['role'] == 'admin'): ?>
                                <th scope="col" class="font-weight-bold">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr class="font-xs">
                                <th scope="row"><?= $order['plat'] ?></th>
                                <th scope="row"><?= $order['quantite'] ?></th>
                                <th scope="row"><?= $order['prix'] ?></th>
                                <th scope="row"><?= $order['date'] ?></th>
                                <th scope="row"><?= $order['heure'] ?></th>
                                <th scope="row">
                                    <span class="badge <?= $order['badge_class'] ?>" style="display: inline-block; text-align: center; font-size: 14px; padding: 8px; width: fit-content;">
                                        <?= $order['statut'] ?>
                                    </span>
                                </th>
                                
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