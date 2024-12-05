<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css" />
    <title>Cantine - Accueil</title>
</head>

<body class="bg-light">
    <div class="container min-vh-100 d-flex flex-column justify-content-between py-5">
        <header class="text-center mb-5">
            <img src="images/logomodifier.png" alt="Logo" class="img-fluid mb-4" style="max-width: 200px;">
            <h1 class="display-4 fw-bold text-primary">Bienvenue à la Cantine</h1>
        </header>

        <main class="flex-grow-1">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <?php if (isset($_SESSION["is_loged_in"])) { ?>
                        <div class="card shadow-sm p-4 mb-4">
                            <h2 class="h4 mb-4">Bonjour <?php echo htmlspecialchars($_SESSION['email']); ?> !</h2>
                            <div class="d-grid gap-3">
                                <a href='in_dashbord.php' class="btn btn-primary">
                                    <i class="fas fa-home me-2"></i>Tableau de bord
                                </a>
                                <a href='logout.php' class="btn btn-outline-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Se déconnecter
                                </a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card shadow-sm p-4">
                            <h2 class="h4 mb-4">Connectez-vous pour accéder à votre espace</h2>
                            <div class="d-grid gap-3">
                                <a href='login.php' class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                </a>
                                <a href='inscription.php' class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>

        <footer class="text-center mt-5">
            <p class="text-muted">
                Créé par <a href="#" class="text-decoration-none">Majda</a>
                <span class="mx-2">|</span>
                <i class="fas fa-code"></i> avec <i class="fas fa-heart text-danger"></i>
            </p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>