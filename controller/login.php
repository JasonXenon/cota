<?php
session_start();

include '../model/read.php';

//on évite des risques en travaillant avec une variable interne au lieu des infos venant directement de l'HTML
$data = $_POST;
unset($_POST); 

//on appelle des fonctions pour lire les infos correspondantes au pseudo introduit par l'utilisateur et on assigne le résultat à des variables
$getUserInfo = readUser($data['pseudo']);
$getProfInfo = readProfile($data['pseudo']);

//on vérifie si les champs du formulaire existent toujours et s'ils ne sont pas vides
if(isset($data['pseudo']) && isset($data['pass'])){
    
	if(!empty($data['pseudo']) && !empty($data['pass'])){
      
	  //on vérifie si le pseudo introduit correspond à un pseudo existant dans la db, et si le mot de passe introduit correspond au hash dans la db
	  if($data['pseudo'] == $getUserInfo['userPseudo']  && password_verify($data['pass'], $getUserInfo['userPass'])){
        
		//on attribue les résultats des requêtes (contenues dans les variables $getUserInfo et $getProfInfo) à $_SESSION pour pouvoir les réutiliser de manière globable dans tous les fichiers tant que la session n'est pas détruite
		$_SESSION['log'] = $getUserInfo;
		foreach($getProfInfo as $key=>$value){
			
				$_SESSION['profileID'] = $value['profileID']; 
				$_SESSION['profileAvatar'] = $value['profileAvatar']; 
				$_SESSION['profileBackgroundColor'] = $value['profileBackgroundColor'];
				$_SESSION['userPseudo'] = $value['userPseudo'];//pq est-ce que ça marche??? c'est même pas selectionné dans la bonne table hein!?
				$_SESSION['profileCreationDate'] = date("d-m-Y", strtotime($value['profileCreationDate'])) ;
				$_SESSION['profileBlockType'] = $value['profileBlockType'];
				$_SESSION['profileBio'] = $value['profileBio'];
		}
	
	header('Location: ../index.php?profileID='.$_SESSION['profileID'].'profileAvatar='.$_SESSION['profileAvatar'].'userPseudo='.$_SESSION['userPseudo']/*.'loguserpseudo='.$_SESSION['log']['userPseudo']*/);
      
	  }else{
        header('Location: ../index.php?erreur=Pseudo ou mot de passe incorrect');
		}
    }else{
      header('Location: ../index.php?erreur=Au moins un des champs requis est vide');
		}
}else{
    header('Location: ../index.php?erreur=Bien essayé');
	}


?>