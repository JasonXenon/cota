<?php

//penser à mettre include général de connection.php en haut peut-être?

//pour prendre les infos de l'utilisateur correspondantes au pseudo introduit dans le formulaire de login  
function readUser($pseudo){
    include 'connection.php';
     $query = "SELECT userPseudo, userPass, userNiveauID, userEmail, userNom, userPrenom, userID
               FROM ifo_user
               WHERE userPseudo = :log"; 
     $query_params = array(':log' => $pseudo);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
     $result = $stmt->fetchall();
     return $result[0];
  }



  function readCurrentUser(){
    include 'connection.php';
    $userID = $_SESSION['profileID'];
    $query = "SELECT userPseudo, userPass, userNiveauID, userEmail, userNom, userPrenom, userID, profileID
              FROM ifo_user
              INNER JOIN ifo_profile ON userID = profileUserID
              WHERE profileID = :log"; 
    $query_params = array(':log' => $userID);
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return $result[0];
}


  function readUserInfos(){
    include 'connection.php';
     $query = "SELECT userNom, userPrenom, userEmail, userPseudo, userID
               FROM ifo_user
               where userNiveauID = 2
               order by userID"; 
     $query_params = array();
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
     $result = $stmt->fetchall();
     return $result;
  }
  
  function readRdvs($user_id) {
    include "connection.php";
    $query = "SELECT rdv.*, jeu.jeu_nom
              FROM ifo_rdv rdv
              INNER JOIN ifo_jeu jeu ON rdv.rdv_jeu_id = jeu.jeu_id
              WHERE rdv.rdv_pseudo = :pseudo";
    $query_params = array(
        ":pseudo" => $_SESSION['userPseudo']
    );
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Failed query : " . $ex->getMessage());
    }

    $result = $stmt->fetchAll();
    return $result;
}

  function readRdvAndJeuInfos() {
    include 'connection.php';
    $query = "SELECT ifo_rdv.*, ifo_jeu.*, ifo_rdv.confirmation_status 
              FROM ifo_rdv 
              INNER JOIN ifo_jeu 
              ON ifo_rdv.rdv_jeu_id = ifo_jeu.jeu_id";
    $query_params = array();
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return $result;
}

  function readPendingAppointments(){
    include 'connection.php';
    $query = "SELECT ifo_rdv.rdv_id, ifo_rdv.rdv_pseudo, ifo_rdv.rdv_date_start, ifo_rdv.rdv_date_end, ifo_jeu.jeu_nom
              FROM ifo_rdv
              INNER JOIN ifo_jeu ON ifo_rdv.rdv_jeu_id = ifo_jeu.jeu_id
              WHERE ifo_rdv.confirmation_status = 'en attente'"; 
    $query_params = array();
    try{
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchAll();
    return $result;
}


function readPendingAppointmentsCount(){
    include 'connection.php';
    $query = "SELECT COUNT(ifo_rdv.rdv_id) as pendingAppointmentsCount
    FROM ifo_rdv
    WHERE ifo_rdv.confirmation_status = 'en attente'";
    $query_params = array();
    try{
    $stmt = $db->prepare($query);
    $stmt->execute($query_params);
    }
    catch(PDOException $ex){
    die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetch();
    return $result['pendingAppointmentsCount'];
    }


  function readUserPk($pk){
    include 'connection.php';
     $query = "SELECT userNom, userPrenom, userEmail, userPseudo, userNiveauID, niveauID, userID
               FROM ifo_user
               INNER JOIN ifo_niveau
               ON niveauID = userNiveauID
               WHERE userID = :pk"; 
     $query_params = array(':pk' => $pk);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
     $result = $stmt->fetchall();
     return $result[0];
  }

//fusionner avec readUser peut-être? et travailler avec des variables contenant le résultat du read --> $userinfo[userID] par exemple
  function readPseudo($login){
    include 'connection.php';
     $query = "SELECT userID, userPseudo
               FROM ifo_user
               WHERE userPseudo = :log"; 
     $query_params = array(':log' => $login);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
     $result = $stmt->fetchall();
     return $result[0];
  }

//pour prendre les jeux contenus dans la table des jeux
function readGame() {
    include 'connection.php';
    $query = "SELECT jeu_id, jeu_nom
              FROM ifo_jeu"; 
    $query_params = array();
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return $result;
}

//pour prendre l'ID de profil correspondant au pseudo de l'utilisateur, introduit dans le formulaire de login, via la clé étrangère 
function readProfile($pseudo){
    include('connection.php');
     $query = "SELECT *
               FROM ifo_profile
               INNER JOIN ifo_user ON profileUserID=userID
			   WHERE userPseudo = :log";
			    
     $query_params = array(':log' => $pseudo);
     try{
         $stmt = $db->prepare($query);
         $result = $stmt->execute($query_params);
     }
     catch(PDOException $ex){
         die("Failed query : " . $ex->getMessage());
     }
     $result = $stmt->fetchall();
     return $result;
  }



?>