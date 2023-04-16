<?php
//faudra fusionner les fonctions pour aller vers un updateProfile plus général

function updateAvatar($uploadExtension){
    include('connection.php');
     $query = "UPDATE ifo_profile SET profileAvatar = :avatar WHERE profileID = :profileID";
     $query_params = array(':avatar' =>$_SESSION['profileID'].".".$uploadExtension,
                           ':profileID'=>$_SESSION['profileID']);                            
	 try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}


function reUpdateAvatar(){
include('connection.php');
     $query = "UPDATE ifo_profile SET profileAvatar = :avatar WHERE profileID = :profileID";
     $query_params = array(':avatar' =>$_SESSION['profileAvatar'],
                           ':profileID'=>$_SESSION['profileID']);                            
	 try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}

function updateBackgroundColor($color){
    include('connection.php');
     $query = "UPDATE ifo_profile SET profileBackgroundColor = :color WHERE profileID = :profileID";
     $query_params = array(':color' =>$color,
                           ':profileID'=>$_SESSION['profileID']);                            
	 try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}

function updateBio($bio){
    include('connection.php');
     $query = "UPDATE ifo_profile SET profileBio = :bio WHERE profileID = :profileID";
     $query_params = array(':bio' =>$bio,
                           ':profileID'=>$_SESSION['profileID']);                            
	 try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}

function updateBlockType($blockType){
    include('connection.php');
     $query = "UPDATE ifo_profile SET profileBlockType = :blockType WHERE profileID = :profileID";
     $query_params = array(':blockType' =>$blockType,
                           ':profileID'=>$_SESSION['profileID']);                            
	 try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}

function updateUser($infos, $pk, $ancien_pseudo) {
    include('connection.php');
    $query = "UPDATE ifo_user
              SET userNom = :nom,
                  userPrenom = :prenom,
                  userEmail = :mail,
                  userPseudo = :pseudo
              WHERE userID = :pk";
    $query_params = array(':nom' => $infos["nom"],
                          ':prenom' => $infos["prenom"],
                          ':mail' => $infos["mail"],
                          ':pseudo' => $infos["pseudo"],
                          ':pk' => $pk);
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
        
        // Ajout de la requête pour mettre à jour la table ifo_rdv
        $query_rdv = "UPDATE ifo_rdv SET rdv_pseudo = :nouveau_pseudo WHERE rdv_pseudo = :ancien_pseudo";
        $query_params_rdv = array(':nouveau_pseudo' => $infos["pseudo"], ':ancien_pseudo' => $ancien_pseudo);
        $stmt_rdv = $db->prepare($query_rdv);
        $result_rdv = $stmt_rdv->execute($query_params_rdv);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}

function updateRdvStatus($status, $rdv_id) {
    include('connection.php');
    // Construction de la requête pour mettre à jour le statut
    if ($status == "accept") {
        $query = "UPDATE ifo_rdv SET confirmation_status = 'Accepté' WHERE rdv_id = :rdv_id";
    } else {
        $query = "UPDATE ifo_rdv SET confirmation_status = 'À reporté' WHERE rdv_id = :rdv_id";
    }
    $query_params = array(':rdv_id' => $rdv_id);
    // Exécution de la requête
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
        return $result;
    } catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }
}

?>