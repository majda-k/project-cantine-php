<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../connexion.php';

    // Vérification des champs requis
    if (
        isset($_POST['id'], $_POST['plat'], $_POST['quantite'], $_POST['jourCommande'], $_POST['heure'], $_POST['prix'])
    ) {
        $id = $_POST['id'];
        $plat = $_POST['plat'];
        $quantite = $_POST['quantite'];
        $jourCommande = is_array($_POST['jourCommande']) ? implode(',', $_POST['jourCommande']) : $_POST['jourCommande'];
        $heure = $_POST['heure'];
        $prix = $_POST['prix'];

        // Préparation de la requête d'UPDATE
        $pdostat = $connexion->prepare('UPDATE planningscommandeclients 
            SET id_plat = :id_plat, 
                quantite = :quantite, 
                jourCommande = :jourCommande, 
                heure = :heure, 
                prix = :prix 
            WHERE id = :id');

        // Liaison des valeurs
        $pdostat->bindValue(':id', $id, PDO::PARAM_INT);
        $pdostat->bindValue(':id_plat', $plat, PDO::PARAM_STR);
        $pdostat->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $pdostat->bindValue(':jourCommande', $jourCommande, PDO::PARAM_STR);
        $pdostat->bindValue(':heure', $heure, PDO::PARAM_STR);
        $pdostat->bindValue(':prix', $prix, PDO::PARAM_INT);

        // Exécution de la requête
        $executeisOk = $pdostat->execute();

        if ($executeisOk) {
            header( 'location: ../in_planing_command.php' );
        } else {
            echo "Échec de la mise à jour du planning de commande.";
        }
    } else {
        echo "Erreur : Tous les champs requis ne sont pas remplis.";
    }
} else {
    echo "Erreur : Méthode de requête non prise en charge.";
}
?>
