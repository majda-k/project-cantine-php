<?php
session_start();
include "./connexion.php" ;

// Check if user is logged in
if (!isset($_SESSION['is_loged_in'])) {
    header('Location: login.php');
    exit();
}

// Get user role
 $userRole = isset($_SESSION['role']) ? $_SESSION['role'] :null ;
?>

<!DOCTYPE html>
<html lang="en">
<?php include("./htmlHeader/HeadTag.php"); ?>

<body>
    <div class="flex">
        <?php
        require_once "./components/menu.php";
        $action = isset($_POST['action']) ? $_POST['action'] :null ;

        // Include the appropriate dashboard based on user role
        switch ($userRole) {

            case 'client':
            case 'admin':

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($action)) {
                    if ($action === "openCreateForm") {
                        include("./controler_in_planing_command/creationplanningscommande.php");
                    } else if ($action === "modifier") {
                        include("./controler_in_planing_command/formModificationplannings.php");
                    } else if ($action === "supprimer") {
                        include("./controler_in_planing_command/supprimerplannings.php");
                    }
                } else {
                    include("./controler_in_planing_command/planningsCommandeClient.php");
                }

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