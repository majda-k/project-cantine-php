<?php 

include 'connexion.php';
if (isset($_GET['id'])) {
    // Récupération de l'ID à supprimer
    $id = $_GET['id'];

$pdostat = $connexion->prepare('DELETE FROM users WHERE id=:id LIMIT 1 ');

$pdostat->bindValue(':id' , $_GET['id'] ,PDO::PARAM_INT);

$executeisOk = $pdostat->execute();


if ($executeisOk) {
    header( 'location: listEmployesAdmin.php' );
} else {
    echo  "echec de la suppression du client  " ;
}
}else{
    echo "Erreur : aucun ID de client fourni pour la suppression.";
}

?>