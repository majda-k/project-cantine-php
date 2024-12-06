  <!-- debut content6 creation plannings commande clients -->
  <!--debut menu -->
  <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
        include "../connexion.php";
        $plat = $_POST['plat'] ?? null;
        $quantite =  $_POST['quantite'] ?? null;
        $jourCommande = isset($_POST['jourCommande']) ? implode(',', $_POST['jourCommande']) : null;
        $heure = $_POST['heure'] ?? null;
        $prix =  $_POST['prix'] ?? null;
        $idClient = $_POST['idClient'] ?? null;


        if ($plat && $quantite && $jourCommande && $heure && $prix && $idClient) {

            // preparation de la requete 

            $pdostat = $connexion->prepare('
               INSERT INTO planningscommandeclients 
                    (plat, quantite, jourCommande, heure, prix, idClient) 
                    VALUES (:plat, :quantite, :jourCommande, :heure, :prix, :idClient)
                ');

            //on relie chaque requete a la valeur 

            $pdostat->bindValue(':plat', trim($plat), PDO::PARAM_STR);
            $pdostat->bindValue(':quantite', $quantite, PDO::PARAM_INT);
            $pdostat->bindValue(':jourCommande', trim($jourCommande), PDO::PARAM_STR);
            $pdostat->bindValue(':heure', trim($heure), PDO::PARAM_STR);
            $pdostat->bindValue(':prix', $prix, PDO::PARAM_INT);
            $pdostat->bindValue(':idClient', $idClient, PDO::PARAM_INT);

            //execution de la requete 

            $insertisOk = $pdostat->execute();

            if ($insertisOk) {
                header('location: ../in_planing_command.php ');
            }
        }
    } else if (isset($_POST['action'])) {
        $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
        //get all client for setting them in the form select
        //get all plat for setting them in the form select

        if (isset($_POST['user_id'])) {
            $user_id = $_POST["user_id"];
        }

    ?>
      <div class="container py-4">
          <!-- Header -->
          <div class="row mb-4">
              <div class="col">
                  <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Client' ?></h2>
              </div>
          </div>

          <!-- Main Content -->
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title mb-0">Créer votre Planning de commande</h3>
                      </div>
                      <div class="card-body">
                          <form action="/project-cantine-php/controler_in_planing_command/creationplanningscommande.php" method="POST">
                              <!-- ID Client -->
                            <!-- this shoud be select for admin-->
                              <div class="mb-3">
                                  <label class="form-label">ID Client</label>
                                  <input type="text" class="form-control" name="idClient"
                                      value="<?php echo ($userrole !== 'admin') ? $user_id : ''; ?>"
                                      placeholder="ID Client"
                                      <?php echo ($userrole !== 'admin') ? 'disabled' : ''; ?>>
                              </div>

                              <!-- Plat -->
                               <!-- this shoud be select -->
                              <div class="mb-3">
                                  <label class="form-label">Plat</label>
                                  <input type="text" class="form-control" name="plat" placeholder="Choisissez votre plat">
                              </div>

                              <!-- Quantité -->
                              <div class="mb-3">
                                  <label class="form-label">Quantité</label>
                                  <input type="number" class="form-control" name="quantite" placeholder="Quelle quantité choisissez-vous ?">
                              </div>

                              <!-- Jour de Commande -->
                              <div class="mb-3">
                                  <label class="form-label">Jour de Commande</label>
                                  <div class="row row-cols-2 row-cols-md-3 g-3">
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="lundi" id="lundi">
                                              <label class="form-check-label" for="lundi">Lundi</label>
                                          </div>
                                      </div>
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="mardi" id="mardi">
                                              <label class="form-check-label" for="mardi">Mardi</label>
                                          </div>
                                      </div>
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="mercredi" id="mercredi">
                                              <label class="form-check-label" for="mercredi">Mercredi</label>
                                          </div>
                                      </div>
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="jeudi" id="jeudi">
                                              <label class="form-check-label" for="jeudi">Jeudi</label>
                                          </div>
                                      </div>
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="vendredi" id="vendredi">
                                              <label class="form-check-label" for="vendredi">Vendredi</label>
                                          </div>
                                      </div>
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="samedi" id="samedi">
                                              <label class="form-check-label" for="samedi">Samedi</label>
                                          </div>
                                      </div>
                                      <div class="col">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="jourCommande[]" value="dimanche" id="dimanche">
                                              <label class="form-check-label" for="dimanche">Dimanche</label>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <!-- Heure -->
                              <div class="mb-3">
                                  <label class="form-label">Heure</label>
                                  <input type="time" class="form-control" name="heure" placeholder="Quelle heure voulez-vous votre commande ?">
                              </div>

                              <!-- Prix -->
                              <div class="mb-3">
                                  <label class="form-label">Prix d'une Commande (MAD)</label>
                                  <div class="input-group">
                                      <input type="number"
                                          class="form-control"
                                          name="prix"
                                          value="26"
                                          min="0"
                                          step="0.5"
                                          required>
                                      <span class="input-group-text">MAD</span>
                                  </div>
                              </div>

                              <input type="hidden" name="idClient" value="<?= $user_id ?>" />

                              <!-- Buttons -->
                              <div class="d-flex gap-2">
                                  <button type="submit" class="btn btn-primary">Créer</button>
                                  <button type="button" class="btn btn-danger" onclick="window.history.back()">Annuler</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <?php

    } else {
        echo "this method not suported yet";
    }


    ?>