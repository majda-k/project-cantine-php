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
    <div class="container flex">
        <?php
        require_once "./components/menu.php";
        $action = isset($_POST['action']) ? $_POST['action'] : null;
        // Include the appropriate dashboard based on user role
        switch ($userRole) {
            case 'admin':
               
            case 'employee':
             
            case 'client':
                include("./controler_historic_commande/ListHistoricCommand.php");
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