<?php
include 'connexion.php';

$pdostat = $connexion->prepare('SELECT * FROM planningscommandeclients');
$executeisOk = $pdostat->execute();
$plannings = $pdostat->fetchAll();


?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;

        font-size: 20px;

    }

    th,
    td {
        padding: 3px;
        border: 1px solid #ddd;
        width: 220px;
        margin-left: -40px;
        padding-bottom: 20px;
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;

    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;

    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table {

        border-radius: 5px;
        overflow: hidden;

    }
</style>





<div class="dashbord-content5 flex flex-column ">
    <!-- debut header -->
    <div class="header">
        <h2 class="ml1">Bonjour Majda</h2>
    </div>
    <!-- fin header -->
    <div class="content5 flex ">
        <div class="creation flex flex-column ">


            <!-- debut tableau -->
            <div class="table mt5 ">
                <table>
                    <thead>
                        <tr class="font-sm">
                            <th scope="col" class="f-w-b ">Plat</th>
                            <th scope="col" class="f-w-b">Quantite</th>
                            <th scope="col" class="f-w-b">jourCommande</th>
                            <th scope="col" class="f-w-b">heure</th>
                            <th scope="col" class="f-w-b">prix</th>
                            <th scope="col p3" class="f-w-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($plannings as $planning):  ?>

                            <tr class="font-sm">
                                <td><?= $planning['plat'] ?></td>
                                <td><?= $planning['quantite'] ?></td>
                                <td><?= $planning['jourCommande'] ?></td>
                                <td><?= $planning['heure'] ?></td>
                                <td><?= $planning['prix'] ?></td>

                                <!-- <th scope="row" class="flex flex-row justify-center "> -->
                                <td><?= $planning['status'] ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>