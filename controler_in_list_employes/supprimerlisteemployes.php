<?php

include '../connexion.php';

if (isset($_POST['user_id'])) {
    // Récupération de l'ID à supprimer
    $id = $_POST['user_id'];
    $redirect = $_POST['redirect'];


    $pdostat = $connexion->prepare('DELETE FROM users WHERE id=:id LIMIT 1 ');

    $pdostat->bindValue(':id', $id, PDO::PARAM_INT);

    $executeisOk = $pdostat->execute();

    if ($executeisOk) {
        if ($redirect !== null) {
            header('location: ../' . $redirect);
        } else {
            header('location: in_listClient.php');
        }
    } else {
        echo  "echec de la suppression du client  ";
    }
} else {
    echo "Erreur : aucun ID de client fourni pour la suppression.";
}
