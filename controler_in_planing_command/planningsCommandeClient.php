<?php
include './connexion.php';



$user_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : null;
$pdostat = $connexion->prepare('SELECT * FROM planningscommandeclients WHERE idClient = :id ');
$pdostat->bindValue(':id', $user_id ,PDO::PARAM_INT) ;

$executeisOk = $pdostat->execute();

//recuperation des resultatsF

$plannings = $pdostat->fetchAll();


// var_dump($plannings);

?>


<style>
    table {
        width: 95%;
        border-collapse: collapse;
        font-size: 20px;
        text-align: center;
      

    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
        width: 200px;

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
        margin: 0px;
    }
</style>
<div class="dashbord-content12 flex flex-column">
    <!-- debut header -->
    <div class="header">
        <h2 class="ml1">Bonjour Majda</h2>
    </div>
    <div class="content5 flex ">
        <div class="creation flex flex-column mr3">
            <form action="in_planing_command.php" method="POST">
                <div class="creation-cmd flex justify-end ">
                  <input type="hidden" name="user_id" value="<?= $user_id ?> ">
                    <button class="ml6 mt3 button-success"
                        type="submit"
                        name="action"
                        value="openCreateForm">creer votre plannings de commande</button>
                </div>
            </form>
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
                            <th scope="col p3" class="f-w-b">Action</th>
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
                                <td><?= $planning['status'] ?></td>
                                <td class="flex justify-center">
                                    <form action="in_planing_command.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $planning['id'] ?>">
                                        <button type="submit" name="action" value="modifier" class="button-success mr2">Modifier</button>
                                    </form>

                                    <form action="in_planing_command.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $planning['id'] ?>">
                                        <button type="submit" name="action" value="supprimer" class="button-danger">Supprimer</button>

                                    </form>
                                </td>
                                </th>


                            </tr>
                        <?php endforeach; ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>