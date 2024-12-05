<!DOCTYPE html>
      <html lang="en">

      <head>
          <meta charset="UTF-8" />
          <meta http-equiv="X-UA-Compatible" content="IE=edge" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Dashboard</title>
          <link rel="stylesheet" href="css/all.min.css" />
          <link rel="stylesheet" href="css/normalize.css" />
          <link rel="stylesheet" href="css/framework.css" />
          <link rel="stylesheet" href="css/menu.css" />
          <link rel="stylesheet" href="css/planningcommande.css" />

          <link rel="preconnect" href="https://fonts.googleapis.com" />
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
          <link
              href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;@500;display=swap"
              rel="stylesheet" />
      </head>

      <body>
          <div class="container flex">
          <?php require_once "menu.php"; ?>
              <!-- fin menu -->

              <div class="dashbord-content flex flex-column">
                  <!-- debut header -->
                  <div class="header">
                      <h2 class="ml1">Bonjour Majda</h2>
                  </div>
                  <!-- fin header -->
                  <div class="content6 flex justify-center mb3 ">
                      <div class="plannings flex flex-column mt3">
                          <h3 class="ml3 mt3 ">Creer votre Plannings commande</h3>
                          <div class="pln-cmd flex flex-column mb4">
                              <form action="" method='POST'>
                                  <div class="plat flex justify-between gap-medium mb3">
                                      <span>Plat</span>
                                      <input type="text" name="plat" placeholder="Choississezvotre plat ?">
                                  </div>
                                  <div class="Qte flex justify-between gap-medium mb3">
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

                                      <button type="submit" class="button-success">Creer</button>

                              </form>
                              </div>
                              <form action="" method="post">
                        <button type="button" class="button-danger" onclick="window.history.back()">Annuler</button>
                    </form>
                         

                      </div>
                  </div>
              </div>
          </div>
          </div>

          </div>