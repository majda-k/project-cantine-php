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
  <link rel="stylesheet" href="css/inscription.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;@500;display=swap"
    rel="stylesheet" />
</head>

<body>
  <div class="inscription">
    <div class="inscription-img">
      <img src="images/backgroundfastfood.jpg" alt="" />
    </div>
    <div class="inscript">
      <div class="flex flex-column inscript-info">
        <h2>S'inscrire</h2>

        <?php
        include("connexion.php");

        if (isset($_POST['inscription'])) {
          $email = $_POST['email'];
          $password = $_POST['password'];
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $number = $_POST['number'];
          $entreprise = $_POST['entreprise'];
          $Adresse = $_POST['Adresse'];



          if ($email == "" || $password == "" || $nom == "" || $prenom == "" || $number == "" || $entreprise == "") {
            echo "tous les champs doit etre remplie !!!";
            echo "<br/>";
            echo "<a href='inscription.php'>retourner a la page d'inscription</a> ";
          } else {
            $stmt = $connexion->prepare("INSERT INTO users(email , password , nom , prenom , number ,entreprise )
             VALUES('$email', '$password' ,'$nom' , '$prenom' ,'$number' ,'$entreprise' )");




            $stmt->execute();
            echo "<a href='login.php'>Se connecter</a> ";
            $last_id = $connexion->lastInsertId();
            echo "last insert id is : " . $last_id;


            $stmt = $connexion->prepare("INSERT INTO adresses(Adresse , idClient ) VALUES('$Adresse' ,' $last_id' )");
            $insertisOk = $stmt->execute();


            if ($insertisOk) {
              echo "adresse valide";
            }
          }
        } else {


        ?>


          <form class="flex flex-column" method="post">
            <div class="inscript-form flex flex-column gap-medium">
              <input type="text" name="email" placeholder="Adresse-Email" />
              <input type="text" name="password" placeholder="Mot de passe" />
              <input type="text" name="nom" placeholder="Nom" />
              <input type="text" name="prenom" placeholder="Prenom" />
              <input type="text" name="number" placeholder="Numero de telephone" />
              <input type="text" name="entreprise" placeholder="Nom d'entreprise" />
              <input type="text" name="Adresse" placeholder="Votre Adresse" />
            </div>
            <div class="flex flex-column items-end">
              <input type="submit" name="inscription" value="S'inscrire" class="button-danger " />
              <p>Aller a la page de connexion</p>
            </div>

          </form>
      </div>
      <div class="inscript-img">
        <img src="images/connexion.jpg" alt="" />
      </div>
    </div>
  </div>

<?php
        }

?>


</body>

</html>