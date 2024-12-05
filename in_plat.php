<?php
session_start();
include("./connexion.php");

if (!isset($_SESSION['is_loged_in'])) {
    header('Location: login.php');
    exit();
}
$userRole =  $_SESSION['role'] ?? '';

function load($role)
{
    $action = $_POST['action'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === "details") {
        include("./controler_plat/detailsplatadmin.php");
    } else {

        switch ($role) {
            case 'admin':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($action === "add") {
                        include("./controler_plat/ajouterplatadmin.php");
                    } else if ($action === "edit") {
                        include("./controler_plat/ajouterplatadmin.php");
                    }
                } else {
                    include("./controler_plat/platadmin.php");
                }

                break;
            case 'employee':
            case 'client':
                include("./controler_plat/platclient.php");
                break;
            default:
                // If no valid role, logout user
                session_destroy();
                header('Location: login.php');
                exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include("./htmlHeader/HeadTag.php"); ?>

<body>
    <div class="container flex">
        <?php
        require_once "./components/menu.php";
        load($userRole);

        ?>
    </div>
</body>