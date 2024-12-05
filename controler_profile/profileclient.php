<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    include '../connexion.php';

    $id =  ($_POST['id'])?? null;
    $nom = $_POST['nom'] ?? '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $adresse = isset($_POST['Adresse']) ? $_POST['Adresse'] : '';
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : null;




    $pdostat = $connexion->prepare(
        'UPDATE users
            SET nom = :nom, 
                prenom = :prenom, 
                number = :number, 
                password = :password, 
                email = :email 
            WHERE id = :id'
    );

    $pdostat->bindValue(':id', $id, PDO::PARAM_INT);
    $pdostat->bindValue(':nom', $nom, PDO::PARAM_STR);
    $pdostat->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $pdostat->bindValue(':number', $number, PDO::PARAM_INT);
    $pdostat->bindValue(':password', $password, PDO::PARAM_STR);
    $pdostat->bindValue(':email', $email, PDO::PARAM_STR);


    $executeisOk = $pdostat->execute();

    $pdostat = $connexion->prepare(
        'UPDATE adresses
            SET Adresse=:adresse 
            WHERE idClient = :id
            '
    );

   $pdostat->bindValue(':id', $id, PDO::PARAM_INT);
    $pdostat->bindValue(':adresse', $adresse, PDO::PARAM_STR);


   $executeisOk = $pdostat->execute();

    if ($executeisOk) {
        if ($redirect !== null) {
            header('location: ../' . $_POST['redirect']);
        } else {
            header('location: /project-cantine-php/in_profile.php/controler_profile/profileclient.php?id= ' . $id);
        }

        exit();
    } else {
        echo "Échec de la mise à jour du profile.";
    }
} else {
    include './connexion.php';

    $user_id = $_POST['user_id'] ?? null;
    $redirect =  $_POST['redirect'] ?? null;



    $pdostat = $connexion->prepare('SELECT * FROM users WHERE id = :id');
    $pdostat->bindValue(':id', $user_id, PDO::PARAM_INT);
    $executeisOk = $pdostat->execute();
    $user = $pdostat->fetch();

    if ($user === false) {
        echo "Aucun utilisateur trouvé avec l'ID  $user_id.";
        exit;
    }


    $pdostat = $connexion->prepare('SELECT * FROM adresses WHERE idClient = :id LIMIT 1');
    $pdostat->bindValue(':id', $user_id, PDO::PARAM_INT);
    $executeisOk = $pdostat->execute();
    $adresses = $pdostat->fetch();
?>




    <!-- fin menu -->

    <div class="dashbord-content  ">
        <!-- debut header -->
        <div class="header">
            <h2 class="ml1 mt0 p2">Bonjour </h2>
        </div>
        <!-- fin header -->
        <div class="content4 ">

            <div class="client-modifier ">
                <div class="info-client ">
                    <form action="/project-cantine-php/controler_profile/profileclient.php" method="POST">
                        <div class="nom-pre flex flex-row">
                            <div class="prenom-client mr3">
                                <input type="text" name="id" value="<?= $user['id'] ?>">
                            </div>
                            <div class="prenom-client mr3">
                                <p>prenom</p>
                                <input type="text" name="prenom" value="<?= $user['prenom'] ?>">
                            </div>
                            <div class="nom-client">
                                <p>Nom</p>
                                <input type="text" name="nom" value="<?= $user['nom'] ?>">
                            </div>
                        </div>
                        <div class="adr">
                            <p>Adresse</p>
                            <input type="text" name="Adresse" value="<?= $adresses['Adresse'] ?>">
                        </div>
                        <div class="numero">
                            <p>Numero de Telephone</p>
                            <input type="text" name="number" value="<?= $user['number'] ?>">
                        </div>
                        <div class="motdepasse">
                            <p>Mot de Passe</p>
                            <input type="text" name="password" value="<?= $user['password'] ?>">
                        </div>
                        <div class="email">
                            <p>Email</p>
                            <input type="text" name="email" value="<?= $user['email'] ?>">
                        </div>

                        <div class="button-client flex justify-between mt3">
                            <input type="hidden" name="redirect" value="<?= $redirect ?>">
                            <button type="submit" class="button-success">Enregistrer les modifications</button>
                        </div>

                    </form>
                    <form action="" method="post">
                        <button type="reset" class="button-danger">Annuler</button>
                    </form>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>


<?php }
?>