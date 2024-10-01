<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div id="header">
        Welcome to my page!
    </div>

    <?php

    if (isset($_SESSION["is_loged_in"])) {
    ?>
        Welcome <?php echo $_SESSION['email'] ?> ! <a href='logout.php'>Logout</a><br />
        <br />
        <a href='view.php'>View and Add Products</a>
        <br /><br />
    <?php

    } else {
        echo "You must be logged in to view this page.<br/><br/>";
        echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
    }

    ?>

    <div id="footer">
        Created by <a href="#header" >majda</a>
    </div>
</body>

</html>