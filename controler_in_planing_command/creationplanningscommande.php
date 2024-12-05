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
        if (isset($_POST['user_id'])) {
            $user_id = $_POST["user_id"];
        }

    ?>
      <div class="dashbord-content12 flex flex-column">
          <div class="header">
              <h2 class="ml1">Bonjour Majda</h2>
          </div>
          <div class="content6 flex justify-center mb3 ">
              <div class="plannings flex flex-column mt3">

                  <h3 class="ml3 mt3 ">Creer votre Plannings commande</h3>
                  <div class="pln-cmd flex flex-column mb4">
                      <form action="/project-cantine-php/controler_in_planing_command/creationplanningscommande.php" method='POST'>
                          <div class="plat flex justify-between gap-medium mb3">
                              <span>Id client</span>
                              <input type="text" name="idClient" value="<?php echo ($userrole !== 'admin') ? $user_id : ''; ?>" placeholder="Choississezvotre plat ?" <?php echo ($userrole !== 'admin') ? 'disabled' : ''; ?>>
                          </div>
                          <div class="plat flex justify-between gap-medium mb3">
                              <span>Plat</span>
                              <input type="text" name="plat" placeholder="Choississezvotre plat ?">
                          </div>

                          <div class="plat flex justify-between gap-medium mb3">
                              <span>Quantite</span>
                              <input type="text" name="quantite" placeholder="Quelle Quantite choisissez-vous ?">
                          </div>
                          <div class="jourCommande flex  justify-between gap-medium mb3 ">
                              <span>Jour de Commande</span>
                              <label><input type="checkbox" name="jourCommande[]" value="lundi"> Lundi</label><br>
                              <label><input type="checkbox" name="jourCommande[]" value="mardi"> Mardi</label><br>
                              <label><input type="checkbox" name="jourCommande[]" value="mercredi"> Mercredi</label><br>
                              <label><input type="checkbox" name="jourCommande[]" value="jeudi"> Jeudi</label><br>
                              <label><input type="checkbox" name="jourCommande[]" value="vendredi"> Vendredi</label><br>
                              <label><input type="checkbox" name="jourCommande[]" value="samedi"> Samedi</label><br>
                              <label><input type="checkbox" name="jourCommande[]" value="dimanche"> Dimanche</label><br>
                          </div>
                          <div class="heure flex justify-between gap-medium mb3">
                              <span>L'Heure</span>
                              <input type="text" name="heure" placeholder="Quelle heure voulez-vous votre commande ?">
                          </div>
                          <div class="Prix flex justify-between gap-medium mb3">
                              <span>Prix d'une Commande</span>
                              <input type="text" name="prix" value="26 MAD">
                          </div>
                          <div class="button-pln-cmd flex justify-between">
                              <input type="hidden" name="idClient" value="<?= $user_id ?>" />
                              <button type="submit" class="button-success">Creer</button>
                      </form>
                      <!-- <form> -->
                      <form action="" method="post">
                          <button type="button" class="button-danger" onclick="window.history.back()">Annuler</button>
                      </form>
                      </form>
                  </div>
              </div>
          </div>
      <?php

    } else {
        echo "this method not suported yet";
    }


        ?>