<?php
include "./connexion.php";

$id = $_POST["id"];
$pdostat = $connexion->prepare("SELECT * FROM plat WHERE Id = :id");
$pdostat->bindParam(':id', $id);
$pdostat->execute();
$plat = $pdostat->fetch();
?>

<div class="dashbord-content12 flex flex-column">
  <!-- debut header -->
  <div class="header">
    <h2 class="ml1">Bonjour Majda</h2>
  </div>
  <!-- fin header -->
  <div class="content12 flex flex-column">

    <div class="plat-name flex justify-center mt3 font-xl">

      <span class="f-w-b mr1">Nom Plat :</span>
      <span><?= $plat['nomPlat'] ?></span>
    </div>
    <div class="images-plat flex justify-center gap-small mt3">
      <img src="<?= $plat['imagePlat'] ?>" alt="" />
      <img src="<?= $plat['imagePlat'] ?>" alt="" />
      <img src="<?= $plat['imagePlat'] ?>" alt="" />
    </div>
    <div class="plat-description ml6 mt6 p2">
      <h4>Description</h4>
      <p>
        <?= $plat['descriptionPlat'] ?>
      </p>
      <p>
        Nos Chefs de cuisines, à travers une
        palette d’excellents produits, vous feront
        plonger dans un univers de gout et de
        saveurs, orientés et coachés par nos
        partenaires nutritionnistes, vous
        garantissant au-delà de la variété, un
        équilibre alimentaire.

      </p>
      <div class="avis flex justify-between gap-small">
        <span>Avis Client</span>
        <span>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </span>
      </div>
      <div class="Ecrire-avis flex justify-end mt2">
        <input
          type="text"
          name="Avis"
          value="Ecrire votre Avis"
          class="button-danger t-center" />
      </div>
    </div>
  </div>