

<?php
include './connexion.php';

if (isset($_POST['action'])) {
    if ($action === "supprimer") {


        if (isset($_POST['id'])) {

            $id = $_POST['id'];
            echo $id;

            $pdostat = $connexion->prepare('DELETE FROM commande WHERE id=:id LIMIT 1 ');

            $pdostat->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

            $executeisOk = $pdostat->execute();



            if ($executeisOk) {
                header('location: ./in_historic_command.php');
            } else {
                echo  "echec de la suppression du commande  ";
            }
        }
    } else {
        echo "Erreur : aucun ID de planning fourni pour la suppression.";
    }
}
?>