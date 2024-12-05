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
    <?php
    // Include the appropriate dashboard based on user role
    switch ($userRole) {
        case 'admin':
            include("./controler_plat/platadmin.php");
            break;
        case 'employee':
            include("./controler_plat/platclient.php");
            break;
        case 'client':
            include("./controler_plat/platclient.php");
            break;
        default:
            // If no valid role, logout user
            session_destroy();
            header('Location: login.php');
            exit();
    }
    ?>
</body>