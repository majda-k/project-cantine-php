<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!-- start of HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/framework.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap"
        rel="stylesheet" />
</head>

<body>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['login'])) {
            $email = trim($_POST['email']);
            $password = $_POST['password'] ;
            echo "passsword -- " . $password;
            if (empty($email) || empty($password)) {
                echo "<div style='color: red; margin: 10px 0;'>";
                echo "Le champ nom d'utilisateur ou mot de passe est vide.";
                echo "</div>";
            } else {
                include("connexion.php");

                try {
                    $check_email = $connexion->prepare("SELECT * FROM users WHERE email = :email");
                    $check_email->bindParam(':email', $email);
                    $check_email->execute();
                    $user = $check_email->fetch(PDO::FETCH_ASSOC);

                    if (!$user) {
                        echo "<div style='color: red; margin: 10px 0;'>";
                        echo "Email non trouvé dans la base de données.";
                        echo "</div>";
                    } else {
                        // For plain text passwords in database
                        if ($user['password'] == $_POST['password']) {
                            // Login successful
                            $_SESSION['is_loged_in'] = true;
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['nom'] = $user['nom'];
                            $_SESSION['role'] = $user['role'];

                            // Redirect all roles to the index page
                            header('Location: in_dashbord.php');
                            exit();
                        } else {
                            echo "<div style='color: red; margin: 10px 0;'>";
                            echo "Mot de passe incorrect. " . $user['password'] . " -- " . $password;
                            echo "</div>";
                        }
                    }
                } catch (PDOException $e) {
                    echo "<div style='color: red; margin: 10px 0;'>";
                    echo "Database error: " . $e->getMessage();
                    echo "</div>";
                }
            }
        } elseif (isset($_POST['singup'])) {
            header('Location: inscription.php');
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
                                <input type="email" name="email" placeholder="Entrer votre adresse email" required />
                                <input type="password" 
                                       name="password" 
                                       placeholder="mot de passe" 
                                       required 
                                />
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
    
    }else {
        echo "this method not suported yet";
    }
    ?>



    <!-- END PHP AND HTML -->













    <!-- end OF HTML -->
</body>

</html>