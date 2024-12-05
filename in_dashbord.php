<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['is_loged_in'])) {
    header('Location: login.php');
    exit();
}

// Get user role
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>
<!DOCTYPE html>
<html lang="en">
  <?php include("./htmlHeader/HeadTag.php"); ?>
  <body>
  <div class="flex">
  <?php require_once "./components/menu.php"; ?>
    <?php
    // Include the appropriate dashboard based on user role
    switch($userRole) {
        case 'admin':
            include("./countroler_dashbord/Acceuil_admin.php");
            break;
        case 'employee':
            include("./countroler_dashbord/Acceuil_employe.php");
            break;
        case 'client':
            include("./countroler_dashbord/Acceuil_client.php");
            break;
        default:
            // If no valid role, logout user
            session_destroy();
            header('Location: login.php');
            exit();
    }
    ?>
  </div>
  </body>
</html>
