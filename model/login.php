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
			//foreach($value as $keys=>$values){
		$profID = $value['profileID']; 
		$profAva = $value['profileAvatar']; //}
		$profBG = $value['profileBackgroundColor'];
		}
		
		$_SESSION['profileID'] = $profID;
		$_SESSION['profileAvatar'] = $profAva;
		$_SESSION['profileBackgroundColor'] = $profBG;
		$_SESSION['userPseudo'] = $getUserInfo['userPseudo'];
		
		header('Location: ../index.php?message=Connecté');
      
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