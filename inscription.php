<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription - Cantine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <style>
        .register-container {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .img-container {
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Left side - Image -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="img-container" style="background-image: url('images/backgroundfastfood.jpg');"></div>
            </div>
            
            <!-- Right side - Registration Form -->
            <div class="col-lg-6">
                <div class="register-container d-flex align-items-center justify-content-center p-4">
                    <div class="w-100" style="max-width: 500px;">
                        <div class="text-center mb-4">
                            <!-- <img src="images/logomodifier.png" alt="Logo" class="img-fluid mb-4" style="max-width: 150px;"> -->
                            <h2 class="fw-bold text-primary">S'inscrire</h2>
                        </div>

                        <?php
                        include("connexion.php");

                        if (isset($_POST['inscription'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $number = $_POST['number'];
                            $entreprise = $_POST['entreprise'];
                            $Adresse = $_POST['Adresse'];

                            if ($email == "" || $password == "" || $nom == "" || $prenom == "" || $number == "" || $entreprise == "") {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Tous les champs doivent être remplis !
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                            } else {
                                try {
                                    $stmt = $connexion->prepare("INSERT INTO users(email, password, nom, prenom, number, entreprise) 
                                        VALUES(:email, :password, :nom, :prenom, :number, :entreprise)");
                                    
                                    $stmt->bindParam(':email', $email);
                                    $stmt->bindParam(':password', $password);
                                    $stmt->bindParam(':nom', $nom);
                                    $stmt->bindParam(':prenom', $prenom);
                                    $stmt->bindParam(':number', $number);
                                    $stmt->bindParam(':entreprise', $entreprise);
                                    
                                    $stmt->execute();
                                    $last_id = $connexion->lastInsertId();

                                    $stmt = $connexion->prepare("INSERT INTO adresses(Adresse, idClient) VALUES(:adresse, :idClient)");
                                    $stmt->bindParam(':adresse', $Adresse);
                                    $stmt->bindParam(':idClient', $last_id);
                                    $insertisOk = $stmt->execute();

                                    if ($insertisOk) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                Inscription réussie ! 
                                                <a href="login.php" class="alert-link">Cliquez ici pour vous connecter</a>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                              </div>';
                                    }
                                } catch(PDOException $e) {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Erreur: ' . $e->getMessage() . '
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>';
                                }
                            }
                        } else {
                        ?>

                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <form method="post">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mot de passe</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="prenom" class="form-label">Prénom</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="number" class="form-label">Téléphone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    <input type="tel" class="form-control" id="number" name="number" placeholder="Votre numéro">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="entreprise" class="form-label">Entreprise</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                    <input type="text" class="form-control" id="entreprise" name="entreprise" placeholder="Nom de l'entreprise">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="Adresse" class="form-label">Adresse</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" class="form-control" id="Adresse" name="Adresse" placeholder="Votre adresse">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" name="inscription" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-2"></i>S'inscrire
                                        </button>
                                        <a href="login.php" class="btn btn-outline-primary">
                                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>