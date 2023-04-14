<?php
include '../model/connection.php';

// Récupération des données de la requête
$rdv_id = $_POST['pk'];
$status = $_POST['status'];

// Construction de la requête pour mettre à jour le statut
if ($status == "accept") {
    $query = "UPDATE ifo_rdv SET confirmation_status = 'Accepté' WHERE rdv_id = :rdv_id";
} else {
    $query = "DELETE from ifo_rdv WHERE rdv_id = :rdv_id";
}

$query_params = array(':rdv_id' => $rdv_id);

// Exécution de la requête
try {
    $stmt = $db->prepare($query);
    $result = $stmt->execute($query_params);
} catch (PDOException $ex) {
    die("Failed to run query: " . $ex->getMessage());
}

// Redirection vers la page d'administration des rendez-vous
header('Location: ../view/admin.php');
exit;

?>
