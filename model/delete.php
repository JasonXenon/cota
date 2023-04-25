<?php

function deleteUser($pk){
    include('connection.php');
    try{
        // Suppression des rendez-vous associés à l'utilisateur
        $query_rdv = "DELETE FROM ifo_rdv WHERE rdv_pseudo IN (SELECT userPseudo FROM ifo_user WHERE userID = :pk)";
        $query_params_rdv = array(":pk" => $pk);
        $stmt_rdv = $db->prepare($query_rdv);
        $stmt_rdv->execute($query_params_rdv);
        
        // Suppression de l'utilisateur
        $query = "DELETE FROM ifo_user
                  WHERE userID = :pk";
        $query_params = array(":pk" => $pk);
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}



?>