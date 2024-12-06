<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    include '../connexion.php';

    $id =  $_POST['id'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $prenom =  $_POST['prenom'] ?? null;
    $number = $_POST['number'] ?? null;
    $password = $_POST['password'] ?? null;
    $email =  $_POST['email'] ?? null;
    $adresse =  $_POST['Adresse'] ?? null;
    $redirect = $_POST['redirect'] ?? null;




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
        if ($redirect !== null && $redirect !== '') {
            header('location: ../' . $redirect);
        } else {
            header('location: /project-cantine-php/in_profile.php');
        }

        exit();
    } else {
        echo "Échec de la mise à jour du profile.";
    }
} else {
    include './connexion.php';

    $user_id = $_POST['user_id'] ?? $_SESSION['user_id'] ?? null;
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

    <div class="container py-4">
    <div class="row mb-4">
            <div class="col">
                <h2 class="h3">Bonjour <?= $user['prenom'] . ' ' . $user['nom'] ?></h2>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="profileForm" action="http://localhost/project-cantine-php/controler_profile/profileclient.php" method="POST">
                            <div class="row g-3">
                                <!-- ID Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ID Client</label>
                                        <input type="text" class="form-control" name="id" data-original="<?= $user['id'] ?>" value="<?= $user['id'] ?>" disabled>
                                        <input type="hidden" name="id" data-original="<?= $user['id'] ?>" value="<?= $user['id'] ?>">
                                    </div>
                                </div>

                                <!-- Prenom Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Prénom</label>
                                        <input type="text" class="form-control" name="prenom" data-original="<?= $user['prenom'] ?>" value="<?= $user['prenom'] ?>">
                                    </div>
                                </div>

                                <!-- Nom Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nom</label>
                                        <input type="text" class="form-control" name="nom" data-original="<?= $user['nom'] ?>" value="<?= $user['nom'] ?>">
                                    </div>
                                </div>

                                <!-- Adresse Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Adresse</label>
                                        <input type="text" class="form-control" name="Adresse" data-original="<?= $adresses['Adresse'] ?>" value="<?= $adresses['Adresse'] ?>">
                                    </div>
                                </div>

                                <!-- Numero Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Numéro de Téléphone</label>
                                        <input type="text" class="form-control" name="number" data-original="<?= $user['number'] ?>" value="<?= $user['number'] ?>">
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Mot de Passe</label>
                                        <input type="password" class="form-control" name="password" data-original="<?= $user['password'] ?>" value="<?= $user['password'] ?>">
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" data-original="<?= $user['email'] ?>" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="redirect" value="<?= $redirect ?>">

                            <!-- Buttons -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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
            const form = document.getElementById('profileForm');
            const inputs = form.getElementsByTagName('input');

            for (let input of inputs) {
                const originalValue = input.getAttribute('data-original');
                if (originalValue) {
                    input.value = originalValue;
                }
            }
        }
    </script>


<?php }
?>