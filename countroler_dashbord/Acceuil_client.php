<!-- Start of Dashboard -->
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
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
          <?php for ($i = 0; $i < 3; $i++) : ?>
            <div class="col-md-4 mb-3">
              <div class="card shadow-sm">
                <div class="card-body">
                  <p><strong>ID:</strong> 1234</p>
                  <p><strong>Plat:</strong> Burger Chicken</p>
                  <p><strong>Quantité:</strong> 6</p>
                  <p><strong>Jour de Commande:</strong></p>
                  <div class="d-flex flex-wrap">
                    <?php foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $jour) : ?>
                      <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="jour" id="jour<?= $jour ?>" />
                        <label class="form-check-label" for="jour<?= $jour ?>"><?= $jour ?></label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <p><strong>L'Heure:</strong> 12h45</p>
                  <p><strong>Prix d'une Commande:</strong> 26 MAD</p>
                  <p><strong>Créé en:</strong> 09/09/2021 - 12h00</p>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
        <form action="planningsCommandeClient.php">
          <button class="btn btn-primary">See More</button>
        </form>
      </div>
      <!-- Popular Dishes -->
      <div>
        <h3>Plats Populaires</h3>
        <div class="row">
          <?php foreach (['burger-img.jpg', 'pzza.img', 'burgercheese-img.jpg'] as $image) : ?>
            <div class="col-md-4 mb-3">
              <div class="card shadow-sm">
                <img src="images/<?= $image ?>" class="card-img-top" alt="Dish Image">
                <div class="card-body">
                  <p><strong>Nom:</strong> Burger Chicken</p>
                  <p><strong>Prix:</strong> 16 MAD</p>
                  <p><strong>Avis Client:</strong>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                  </p>
                  <form action="platclient.php">
                    <button class="btn btn-primary btn-sm">Read More Details</button>
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
        <button class="btn btn-primary">See More</button>
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
        <button class="btn btn-primary mt-3">See More</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Dashboard -->
