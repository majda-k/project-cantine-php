<?php
include "./connexion.php";

$id = $_POST["id"];
$pdostat = $connexion->prepare("SELECT * FROM plat WHERE Id = :id");
$pdostat->bindParam(':id', $id);
$pdostat->execute();
$plat = $pdostat->fetch();
?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Admin' ?></h2>
        </div>
    </div>

  <!-- Plat Name -->
  <div class="text-center mb-4">
    <h3 class="fw-bold">Nom Plat:</h3>
    <p class="text-secondary"><?= $plat['nomPlat'] ?></p>
  </div>

  <!-- Images Section -->
  <div class="row justify-content-center mb-4">
    <?php for ($i = 0; $i < 3; $i++): ?>
      <div class="col-4 col-md-3 mb-3">
        <img src="<?= $plat['imagePlat'] ?>" class="img-fluid rounded shadow-sm" alt="Plat Image">
      </div>
    <?php endfor; ?>
  </div>

  <!-- Description Section -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h4 class="card-title text-primary">Description</h4>
      <p class="card-text">
        <?= $plat['descriptionPlat'] ?>
      </p>
      <p class="card-text">
        Nos Chefs de cuisines, à travers une
        palette d’excellents produits, vous feront
        plonger dans un univers de goût et de
        saveurs. Orientés et coachés par nos
        partenaires nutritionnistes, vous
        garantissant au-delà de la variété, un
        équilibre alimentaire.
      </p>
    </div>
  </div>

  <!-- Client Reviews Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <span class="fw-bold">Avis Client:</span>
    <div>
      <?php for ($i = 0; $i < 5; $i++): ?>
        <i class="fa-solid fa-star text-warning"></i>
      <?php endfor; ?>
    </div>
  </div>

  <!-- Write a Review Section -->
  <div class="text-end">
    <input
      type="text"
      name="Avis"
      placeholder="Écrire votre Avis"
      class="form-control w-50 d-inline-block me-2" />
    <button class="btn btn-primary">Envoyer</button>
  </div>
</div>
