<?php
session_start();
?>
<!-- start of HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/framework.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;@500;display=swap"
        rel="stylesheet" />
</head>

<body>




    <!-- start PHP AND HTML -->


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['login'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($_POST['email'] == "n@n.n" || empty($email) || empty($password)) {
                echo "Either username or password field is empty.";
                echo "<br/>";
                echo "<a href='login.php'>Go back</a>";
            } else {
                $_SESSION['is_loged_in'] =  $email;
                $_SESSION['email'] =   $email;
                $_SESSION['password'] =  $password;
            }

            if (isset($_SESSION['is_loged_in'])) {
                header('Location: index.php');
            }
        } elseif (isset($_POST['singup'])) {
            header('Location: register.php');
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ?>
        <div class="connect">
            <div class="img-connect">
                <img src="images/backgroundfastfood.jpg" alt="" />
            </div>
            <div class="info-connect">
                <div class="connexion">
                    <div class="connexion-info">
                        <h2>Se Connecter</h2>
                        <form action="" method="post">
                            <div class="email flex flex-column">
                                <input type="text" name="email" placeholder="Entrer votre adresse email" required />
                                <input type="text" name="password" placeholder="mot de passe" required />
                            </div>

                            <p class="flex justify-end">Mot de passe oublie ?</p>
                            <div class="button-connexion flex justify-between">
                                <input
                                    class="seconnecter button-success mr1"
                                    type="submit"
                                    name="login"
                                    value="Se Connecter" />
                        </form>
                        <form action="" method="post">
                            <input
                                class="inscrire button-danger"
                                type="submit"
                                name="singup"
                                value="S'inscrire" />
                        </form>

                    </div>


                </div>
                <div class="connexion-img">
                    <img src="images/connexion.jpg" alt="" />
                </div>
            </div>
        </div>
        </div>

    <?php
    } else {
        echo "this method not suported yet";
    }
    ?>



    <!-- END PHP AND HTML -->











    <!-- end OF HTML -->
</body>

</html>