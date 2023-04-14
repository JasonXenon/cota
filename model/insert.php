<?php

//pour insérer les infos du formulaire d'inscription dans la table des utilisateurs
function insertUser($data, $pass){
    include('connection.php');
     $query = "INSERT INTO ifo_user (userNom, userPrenom, userPseudo, userEmail, userPass)
               VALUES (:nom, :prenom, :pseudo, :mail, :mdp)";
     $query_params = array(':prenom'=>$data['prenom'],
                           ':nom'=>$data['nom'],
                           ':pseudo'=>$data['pseudo'],
                           ':mail'=>$data['mail'],
                           ':mdp'=>$pass);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}

//pour insérer un événement du calendrier avec les infos demandées dans la table des rendez-vous
function insertRdv($data, $rdvStart, $rdvFin){
    include('connection.php');
     $query = "INSERT INTO ifo_rdv (rdv_date_start, rdv_date_end, rdv_pseudo, rdv_jeu_id)
               VALUES (:date_start, :date_end, :pseudo, :jeu)";
     $query_params = array(':date_start'=>$rdvStart,
                           ':date_end'=>$rdvFin,
                           ':pseudo'=>$_SESSION['userPseudo'],
                           ':jeu'=>$data['jeu']);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}

//après faudra ajouter un insert de profileCreationDate
//pour insérer(lors de l'inscription) une clé étrangère correspondant à la table des utilisateurs dans la table des profils afin de les lier
function insertProfile($data){
    include('connection.php');
     $query = "INSERT INTO ifo_profile (profileUserID)
               VALUES ((SELECT userID FROM ifo_user WHERE userPseudo = :pseudo))";
     $query_params = array(':pseudo'=>$data['pseudo']);        
	 try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
}



?>