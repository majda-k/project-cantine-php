<?php

include './connexion.php';
$pdostat = $connexion->prepare('SELECT * FROM users WHERE role = "employee" ;');
$insertIsOk = $pdostat->execute();
$users = $pdostat->fetchAll();

?>


<style>
    table {
        width: 100%;

        font-size: 15px;
        margin-left: 80px;

    }

    th,
    td {
        padding: 3px;

        width: 200px;
        padding-bottom: 20px;
    }

    td {
        border-left: 1px solid black;
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


    }
</style>



<div class="dashbord-content content2 flex flex-column">
    <!-- debut header -->
    <div class="header">
        <h2 class="ml1">Bonjour Majda</h2>
    </div>
    <!-- fin header -->
    <div class="content3 flex flex-row">
        <!-- debut tableau -->
        <div class="table">
            <table>
                <thead>
                    <tr class="font-sm">
                        <th scope="col" class="f-w-b ">Id</th>
                        <th scope="col" class="f-w-b ">Nom</th>
                        <th scope="col" class="f-w-b">Prenom</th>
                        <th scope="col" class="f-w-b">Numero de Telephone</th>
                        <th scope="col" class="f-w-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="font-sm">
                        <?php foreach ($users as $user): ?>
                            <td scope="row" class="f-w-b "><?= $user['id'] ?></td>
                            <td scope="row" class="f-w-b "><?= $user['nom'] ?></td>
                            <td scope="row" class="f-w-b"><?= $user['prenom'] ?></td>
                            <td scope="row" class="f-w-b"><?= $user['number'] ?></td>
                            <td class="flex justify-center ">

                            <form action="in_listEmployes.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="redirect" value="/project-cantine-php/in_listEmployes.php">
                                    <button type="submit" name="action" value="openUserProfile" class="button-success mr1 ">Modifier</button>
                                </form>


                                <form action="in_listEmployes.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="redirect" value="/project-cantine-php/in_listEmployes.php">
                                    <button type="submit" name="action" value="deleteUser" class="button-danger mr1 ">Suprimer</button>
                                </form>

                            </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>