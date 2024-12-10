<?php
include_once './connexion.php';

$pdostat = $connexion->prepare('SELECT users.* , adresses.Adresse FROM users INNER JOIN adresses on users.id = adresses.idClient WHERE role = "client" ;');
$insertIsOk = $pdostat->execute();
$users = $pdostat->fetchAll();
?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
           
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Liste des Clients</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle w-auto mx-auto">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Numero de Telephone</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']) ?></td>
                                        <td><?= htmlspecialchars($user['nom']) ?></td>
                                        <td><?= htmlspecialchars($user['prenom']) ?></td>
                                        <td><?= htmlspecialchars($user['number']) ?></td>
                                        <td><?= htmlspecialchars($user['entreprise']) ?></td>
                                        <td><?= htmlspecialchars($user['Adresse']) ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="in_listClient.php" method="POST" class="me-2">
                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <input type="hidden" name="redirect" value="in_listClient.php">
                                                    <button type="submit" name="action" value="openUserProfile"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Modifier
                                                    </button>
                                                </form>

                                                <form action="in_listClient.php" method="POST">
                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <input type="hidden" name="redirect" value="in_listClient.php">
                                                    <button type="submit" name="action" value="deleteUser"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                                        <i class="fas fa-trash"></i> Supprimer
                                                    </button>
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
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce client ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    </div>
</div>