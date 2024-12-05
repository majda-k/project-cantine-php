<?php
session_start();
include "./connexion.php";

// Check if user is logged in
if (!isset($_SESSION['is_loged_in'])) {
    header('Location: login.php');
    exit();
}

// Get user role
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
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

                if($action === "openUserProfile"){
                    include("./controler_profile/profileclient.php");
                }else if($action === "deleteUser"){
                    include("./controler_in_list_employes/supprimerlisteemployes.php");
                }
                else{
                    include("./controler_in_list_employes/listEmployesAdmin.php");
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