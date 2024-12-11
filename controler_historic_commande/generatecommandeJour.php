<?php
include('./connexion.php');

if($_SERVER['REQUEST_METHOD'] === 'POST' && ($action === 'generate')) {

    //step 1 : get planning that we want to generate commandes from it condations:
        //  jourCommande should be today 
    //step 2 :
        // generate commandes from this planning and ignore adding command already added (ignore mysql duplicate key error) [should add all commands on one query]



$pdostat = $connexion->prepare('INSERT INTO commande (idClient, status , id_plat, quantite, jourCommande, heure, prix ,id_planning,  creer_en) 
VALUES
(:idClient, :status , :id_plat, :quantite, :jourCommande, :heure, :prix , :id_planning, :creer_en)');

$pdostat->bindValue(':idClient', $_SESSION['user_id'], PDO::PARAM_INT);
$pdostat->bindValue(':status', 'En Cours de Preparation', PDO::PARAM_STR);
$pdostat->bindValue(':id_plat', random_int(0,1000), PDO::PARAM_INT);
$pdostat->bindValue(':quantite', 43, PDO::PARAM_INT);
$pdostat->bindValue(':jourCommande', 'mardi', PDO::PARAM_STR);
$pdostat->bindValue(':heure', 12, PDO::PARAM_INT);
$pdostat->bindValue(':prix', 23, PDO::PARAM_INT);
$pdostat->bindValue(':creer_en', date('Y-m-d'), PDO::PARAM_STR);
$pdostat->bindValue(':id_planning', random_int(0,1000), PDO::PARAM_INT);


$executeisOk = $pdostat->execute();

}


header('location: /project-cantine-php/in_historic_commande.php');


?>