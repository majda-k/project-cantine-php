<?php
session_start();
include "./connexion.php";

if (!isset($_SESSION['is_loged_in'])) {
    header('Location: login.php');
    exit();
}

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<?php include("./htmlHeader/HeadTag.php"); ?>

<body>
    <div class="container flex">
        <?php
        require_once "./components/menu.php";
        $action = isset($_POST['action']) ? $_POST['action'] : null;

        switch ($userRole) {
            case 'admin':

                if ($action === "openUserProfile") {
                    include("./controler_profile/profileclient.php");
                } else if ($action === "deleteUser") {
                    include("./controler_in_listClient/supprimerlisteclient.php");
                } else {
                    include("./controler_in_listClient/ListClientAdmin.php");
                }
                break;

            default:
                session_destroy();
                header('Location: login.php');
                exit();
        }
        ?>
    </div>
</body>