<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Cantine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <style>
        .login-container {
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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['login'])) {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            
            if (empty($email) || empty($password)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Le champ nom d\'utilisateur ou mot de passe est vide.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                include("connexion.php");

                try {
                    $check_email = $connexion->prepare("SELECT * FROM users WHERE email = :email");
                    $check_email->bindParam(':email', $email);
                    $check_email->execute();
                    $user = $check_email->fetch(PDO::FETCH_ASSOC);

                    if (!$user) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Email non trouvé dans la base de données.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    } else {
                        if ($user['password'] == $_POST['password']) {
                            $_SESSION['is_loged_in'] = true;
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['nom'] = $user['nom'];
                            $_SESSION['role'] = $user['role'];
                            header('Location: in_dashbord.php');
                            exit();
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Mot de passe incorrect.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Database error: ' . $e->getMessage() . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }
            }
        } elseif (isset($_POST['singup'])) {
            header('Location: inscription.php');
        }
    }
    ?>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Left side - Image -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="img-container" style="background-image: url('images/backgroundfastfood.jpg');"></div>
            </div>
            
            <!-- Right side - Login Form -->
            <div class="col-lg-6">
                <div class="login-container d-flex align-items-center justify-content-center p-5">
                    <div class="w-100" style="max-width: 400px;">
                        <div class="text-center mb-4">
                            <!-- <img src="images/logomodifier.png" alt="Logo" class="img-fluid mb-4" style="max-width: 150px;"> -->
                            <h2 class="fw-bold text-primary">Se Connecter</h2>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                placeholder="Entrer votre adresse email" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" 
                                                placeholder="Entrer votre mot de passe" required>
                                        </div>
                                    </div>

                                    <div class="text-end mb-3">
                                        <a href="#" class="text-decoration-none">Mot de passe oublié ?</a>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" name="login" class="btn btn-primary">
                                            <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                                        </button>
                                        <a href="inscription.php" class="btn btn-outline-primary">
                                            <i class="fas fa-user-plus me-2"></i>S'inscrire
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>