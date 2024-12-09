<?php 
include "./connexion.php";
$pdostat = $connexion->prepare('SELECT * FROM planningscommandeclients');
$executeisOk = $pdostat->execute();
$plannings = $pdostat->fetchAll();





$pdostat = $connexion->prepare('SELECT * FROM plat ');



$executeisOk = $pdostat->execute();
$plats = $pdostat->fetchAll();

?>




<!-- Start of Dashboard -->
<div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
  <!-- Header -->
  <div class="row mb-4">
 
    <div class="col">
      <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Admin' ?></h2>
    </div>
  </div>

  <!-- Main Content -->
  <div class="row flex-grow-1">
    <!-- Left Section -->
    <div class="col-md-8">
      <!-- Planning Cards -->
      <section class="mb-4" style="background-color: #f4f4f4; padding: 20px; border-radius: 8px; min-height: 300px;">
        <h3 class="mb-4">Les Derniers Plannings Commande</h3>
        <div class="row g-2">
        <?php
          $maxCard = 3;
          $count = 0;
          foreach ($plannings as $planning) :
            if ($count == $maxCard) break; 
            $count++; ?>
        
        
            <div class="col-md-4">
              <div class="card shadow-lg rounded-3" style="border: 1px solid #ddd; max-height: 600px; overflow: hidden;">
                <div class="card-body p-3">
                  <h5 class="card-title mb-2">ID: <?= $planning['id'] ?></h5>
                  <p class="mb-1"><strong>Plat: <?= $planning['id_plat'] ?></strong></p>
                  <p class="mb-1"><strong>Quantité:</strong> <?= $planning['quantite'] ?></p>
                  <p class="mb-1"><strong>Jour de Commande:</strong></p>
                  <div class="d-flex flex-wrap mb-2">
                    <?php foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $jour) : ?>
                      <div class="form-check me-1">
                      <input class="form-check-input" type="checkbox" name="jour" id="jour<?= $jour ?>" disabled <?php if (str_contains($planning['jourCommande'], strtolower($jour)) !== false) echo 'checked'; ?> />
                      <label class="form-check-label" for="jour<?= $jour ?>"><?= $jour ?></label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <p class="mb-1"><strong>L'Heure:</strong> <?= $planning['heure'] ?></p>
                  <p class="mb-1"><strong>Prix d'une Commande:</strong> <?=$planning['prix'] ?></p>
                  <p><strong>Créé en:</strong> 09/09/2021 - 12h00</p>
                </div>
              </div>
            </div>
            
  
            <?php endforeach; ?>
     
       
        </div>
        <form action="/project-cantine-php/in_planing_command.php" method="post">
        <button type="submit" class="btn btn-primary mt-2">Voir Plus</button>
        </form>
      </section>








      
      <!-- Popular Dishes -->
      <section class="bg-light p-4 rounded" style="background-color: #d1f2d1; min-height: 200px;">
        <h3 class="mb-3">Plats Populaires</h3>
        <div class="row">
          <?php
          // Limiter à 3 cartes maximum
          $maxCard = 3;
          $count = 0;

          // Tableau d'images correspondant aux plats
          $images = ['burger-img.jpg',  'cheeseburger.png' ,'pizza-aux-fruits-de-mer.jpg'];

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
      </section>
    </div>

    <!-- Right Section -->
    <div class="col-md-4">
      <!-- Recent Orders -->
      <section class="mb-4 h-100 d-flex flex-column" style="background-color: #f7d7b3; padding: 20px; border-radius: 8px;">
        <h3 class="text-secondary mb-4">Les Dernières Commandes</h3>
        <div class="flex-grow-1">
          <?php foreach (['burger-img.jpg', 'pzza.img', 'burgercheese-img.jpg'] as $image) : ?>
            <div class="card mb-3 shadow-sm" style="max-height: 200px; overflow: hidden;">
              <div class="row g-0">
                <div class="col-4">
                  <img src="images/<?= $image ?>" class="img-fluid rounded-start" alt="Commande Image">
                </div>
                <div class="col-8">
                  <div class="card-body p-3">
                    <p class="card-text mb-1"><strong>Date:</strong> 09/09/2024 - 12h00</p>
                    <p class="card-text mb-1"><strong>Plat:</strong> Burger Chicken</p>
                    <p class="card-text mb-1"><strong>État:</strong> Complète</p>
                    <p class="card-text mb-1"><strong>Quantité:</strong> 6</p>
                    <p class="card-text"><strong>Prix:</strong> 26 MAD</p>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="btn btn-primary">Voir Plus</button>
      </section>
    </div>
  </div>
</div>
<!-- End of Dashboard -->
