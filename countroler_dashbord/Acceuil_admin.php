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
          <?php for ($i = 0; $i < 3; $i++) : ?>
            <div class="col-md-4">
              <div class="card shadow-lg rounded-3" style="border: 1px solid #ddd; max-height: 200px; overflow: hidden;">
                <div class="card-body p-3">
                  <h5 class="card-title mb-2">Commande #1234</h5>
                  <p class="mb-1"><strong>Plat:</strong> Burger Chicken</p>
                  <p class="mb-1"><strong>Quantité:</strong> 6</p>
                  <p class="mb-1"><strong>Jour de Commande:</strong></p>
                  <div class="d-flex flex-wrap mb-2">
                    <?php foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $jour) : ?>
                      <div class="form-check me-1">
                        <input class="form-check-input" type="radio" name="jour" id="jour<?= $jour ?>" />
                        <label class="form-check-label" for="jour<?= $jour ?>"><?= $jour ?></label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <p class="mb-1"><strong>L'Heure:</strong> 12h45</p>
                  <p class="mb-1"><strong>Prix d'une Commande:</strong> 26 MAD</p>
                  <p><strong>Créé en:</strong> 09/09/2021 - 12h00</p>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
        <button class="btn btn-primary mt-2">Voir Plus</button>
      </section>

      <!-- Popular Dishes -->
      <section class="bg-light p-4 rounded" style="background-color: #d1f2d1; min-height: 200px;">
        <h3 class="mb-3">Plats Populaires</h3>
        <div class="row g-3">
          <?php foreach (['burger-img.jpg', 'pzza.img', 'burgercheese-img.jpg'] as $image) : ?>
            <div class="col-md-4">
              <div class="card shadow-sm">
                <img src="images/<?= $image ?>" class="card-img-top" alt="Plat populaire">
                <div class="card-body text-center">
                  <h5>Burger Chicken</h5>
                  <p><strong>Prix:</strong> 16 MAD</p>
                  <p><strong>Avis Client:</strong></p>
                  <p>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                  </p>
                  <button class="btn btn-outline-primary btn-sm">Détails</button>
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
