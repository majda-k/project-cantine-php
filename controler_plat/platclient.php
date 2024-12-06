<?php

include "./connexion.php";

$pdostat = $connexion->prepare('SELECT * FROM plat');
$executeisOk = $pdostat->execute();
$plats = $pdostat->fetchAll();
?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Client' ?></h2>
        </div>
    </div>
    <!-- Filter Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="filter-info"></div>
        <div class="category d-flex">
            <input
                type="text"
                name="categories"
                placeholder="Categories"
                class="form-control me-2" />
            <input
                type="text"
                name="Chercher"
                placeholder="Chercher"
                class="form-control" />
        </div>
    </div>

    <!-- Plats Section -->
    <div class="row">
        <?php foreach ($plats as $plat): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $plat['imagePlat'] ?>" class="card-img-top" alt="Plat Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $plat['nomPlat'] ?></h5>
                        <p class="card-text">
                            <strong>Prix:</strong> <?= $plat['prixPlat'] ?> MAD<br>
                            <strong>Description:</strong> <?= $plat['descriptionPlat'] ?>
                        </p>
                        <form action="in_plat.php" method="post">
                            <input type="hidden" name="id" value="<?= $plat['Id'] ?>" />
                            <button type="submit" name="action" value="details" class="btn btn-primary w-100">Lire Plus</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fa-solid fa-caret-left"></i></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fa-solid fa-caret-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>
