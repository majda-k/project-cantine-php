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
        <?php
        require_once "./components/menu.php";
        $action = isset($_POST['action']) ? $_POST['action'] : null;
        // Include the appropriate dashboard based on user role
        switch ($userRole) {
            case 'admin':
            case 'client':
            case 'employee':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  $action === 'modifier') {
                    include("./controler_historic_commande/modifierlistcommande.php");
                }else if($_SERVER['REQUEST_METHOD'] === 'POST' &&  $action === 'supprimer'){
                    include("./controler_historic_commande/supprimerlistcommande.php");
                }else if($_SERVER['REQUEST_METHOD'] === 'POST' &&  $action === 'generate'){
                    include("./controler_historic_commande/generatecommandeJour.php");
                }
                else{
                    include("./controler_historic_commande/ListHistoricCommandClient.php");
                }
                break;
           
        }
        ?>
    </div>
</body>