<!-- Start of Dashboard -->

<?php
include './connexion.php';

$idClient = $_SESSION['user_id'] ?? null;


$pdostat = $connexion->prepare('SELECT * FROM planningscommandeclients WHERE idClient = :id');

$pdostat->bindValue(':id', $idClient, PDO::PARAM_INT);

$executeisOk = $pdostat->execute();
$plannings = $pdostat->fetchAll();






$pdostat = $connexion->prepare('SELECT * FROM plat ');



$executeisOk = $pdostat->execute();
$plats = $pdostat->fetchAll();

?>




<div class="container-fluid py-4">
  <!-- Header -->
  <div class="row mb-3">
    <div class="col">
      <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Client' ?></h2>
    </div>
  </div>
  <!-- Main Content -->
  <div class="row">

    <!-- Left Section -->
    <div class="col-md-8">
      <div class="mb-4">
        <h3>Les Dernières Plannings Commande</h3>
        <!-- Planning Cards -->
        <div class="row">
          <?php
          $maxcard = 3;
          $count = 0;

          foreach ($plannings as $planning) :
            if ($count == $maxcard) break;
            $count++;
          ?>



            <div class="col-md-4 mb-2">
              <div class="card shadow-sm">

                <div class="card-body ">


                  <p><strong>Id Plannings :</strong><?= $planning['id'] ?></p>
                  <p><strong>Plat:</strong><?= $planning['id_plat'] ?></p>

                  <p><strong>jourCommande : <?= $planning['jourCommande'] ?></strong></p>
                  <div class="d-flex flex-wrap">
                    <?php foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $jour) : ?>
                      <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="jour" id="jour<?= $jour ?>" disabled <?php if (str_contains($planning['jourCommande'], strtolower($jour)) !== false) echo 'checked'; ?> />
                        <label class="form-check-label" for="jour<?= $jour ?>"><?= $jour ?></label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <p><strong>L'Heure:</strong><?= $planning['heure'] ?></p>
                  <p><strong>Prix d'une Commande:</strong> <?= $planning['prix'] ?></p>
                  <p><strong>Créé en:</strong> 09/09/2021 - 12h00</p>
                  <p><strong>Quantité:</strong> <?= $planning['quantite'] ?></p>

                </div>


              </div>


            </div>

          <?php endforeach; ?>
        </div>
        <form action="/project-cantine-php/in_planing_command.php" method="post">
          <!-- inpu checkbox select -->
          <button type="submit" class="btn btn-primary">Lire Plus</button>
        
        </form>
      </div>

      <!-- Popular Dishes -->
      <div>
        <h3>Plats Populaires</h3>

        <div class="row">
          <?php
          // Limiter à 3 cartes maximum
          $maxCard = 3;
          $count = 0;

          // Tableau d'images correspondant aux plats
          $images = ['burger-img.jpg',  'burgercheese-img.jpg' ,'pizza-aux-fruits-de-mer.jpg'];

          // Parcourir les plats
          foreach ($plats as $index => $plat) :
            if ($count == $maxCard) break; // Stop après $maxCard plats
            $count++;

            // Associer une image en fonction de l'index ou une image par défaut
            $image = $images[$index] ?? 'default-img.jpg';
          ?>

            <div class="col-md-4 mb-3">
              <div class="card shadow-sm">
                <img src="images/<?= $image ?>" class="card-img-top" alt="Dish Image">
                <div class="card-body">
                <p><strong>ID:</strong><?= $plat['Id']; ?></p>
                  <p><strong>Nom:</strong><?= $plat['nomPlat']; ?></p>
                  <p><strong>Prix:</strong> <?= $plat['prixPlat']; ?></p>
                  <p><strong>Avis Client:</strong>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                  </p>
                  <form action="/project-cantine-php/in_plat.php" method="post">
                  <input type="hidden" name="id" value="<?= $plat['Id'] ?>" />
                  <button type="submit" name="action" value="details" class="btn btn-primary w-100">Lire Plus</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- Right Section -->
    <div class="col-md-4">
      <!-- Recent Orders -->
      <div class="mb-4">
        <h3 class="mb-3">Les Derniers Commandes</h3>
        <?php foreach (['burger-img.jpg', 'pzza.img', 'burgercheese-img.jpg'] as $image) : ?>
          <div class="card mb-3 shadow-sm">
            <div class="row g-0">
              <div class="col-4">
                <img src="images/<?= $image ?>" class="img-fluid rounded-start" alt="Dish Image">
              </div>
              <div class="col-8">
                <div class="card-body">
                  <p><strong>Date:</strong> 09/09/2024 - 12h00</p>
                  <p><strong>Plat:</strong> Burger Chicken</p>
                  <p><strong>État de Commande:</strong> Complète</p>
                  <p><strong>Quantité:</strong> 6</p>
                  <p><strong>Prix:</strong> 26 MAD</p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        <button class="btn btn-primary">Lire Plus</button>
      </div>
      <!-- Billing -->
      <div>
        <h3>Facturations</h3>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between">
            <span>Paiement de ce mois</span>
            <span>188 MAD</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Estimation de Paiement</span>
            <span>188 MAD</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Date de Paiement</span>
            <span>05-09-2024</span>
          </li>
        </ul>
        <button class="btn btn-primary mt-3">Lire Plus</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Dashboard -->