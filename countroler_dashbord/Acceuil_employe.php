<!-- Start of Dashboard -->
<div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col">
      <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Admin' ?></h2>
    </div>
  </div>
  <!-- fin header -->
  <div class="row">
    <!-- debut tableau -->
    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-hover table-striped align-middle w-auto mx-auto">
          <thead>
            <tr class="table-primary">
              <th scope="col">ID</th>
              <th scope="col">Client</th>
              <th scope="col">Statut</th>
              <th scope="col">Plat</th>
              <th scope="col">Quantite</th>
              <th scope="col">Date de Commande</th>
              <th scope="col">Heure de Commande</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>12345</td>
              <td>Amira malaki</td>
              <td><span class="badge bg-warning text-dark">En Cours de preparation</span></td>
              <td>Burger Cheese</td>
              <td>1</td>
              <td>09/09/2024</td>
              <td>12h00</td>
              <td><button class="btn btn-outline-primary btn-sm">Details</button></td>
            </tr>
            <tr>
              <td>12375</td>
              <td>Salma Fdli</td>
              <td><span class="badge bg-danger">Commande Annuler</span></td>
              <td>Pizza fruit de mer</td>
              <td>3</td>
              <td>08/09/2024</td>
              <td>13h00</td>
              <td><button class="btn btn-outline-primary btn-sm">Details</button></td>
            </tr>
            <tr>
              <td>12349</td>
              <td>samira ramsis</td>
              <td><span class="badge bg-success">Commande Passer</span></td>
              <td>Burger</td>
              <td>2</td>
              <td>10/09/2024</td>
              <td>12h30</td>
              <td><button class="btn btn-outline-primary btn-sm">Details</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>