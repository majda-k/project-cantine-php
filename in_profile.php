<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("./connexion.php");

// Redirige l'utilisateur si non connecté
if (!isset($_SESSION['is_loged_in'])) {
    header('Location: login.php');
    exit();
}

// Récupère le rôle de l'utilisateur
$userRole = $_SESSION['role'] ?? '';

// Vérifie le rôle de l'utilisateur et inclut le fichier approprié
function load($role)
{
    switch ($role) {

        case 'client':
        case 'admin';
            include "./controler_profile/profileclient.php";
            break;


            // default:
            //     Déconnexion si rôle invalide
            //     session_destroy();
            //     header('Location: login.php');
            //     exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<?php include("./htmlHeader/HeadTag.php"); ?>

<body>
    <div class="flex">
        <?php
        require_once "./components/menu.php";
        load($userRole);
        ?>
    </div>
</body>