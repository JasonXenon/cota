<?php
include '../model/connection.php';
include '../model/insert.php';
include 'fonctions.php';

//on évite des risques en travaillant avec une variable interne au lieu des infos venant directement de l'HTML
$data = $_POST;
unset($_POST);

//on vérifie si les champs du formulaire existent toujours et s'ils ne sont pas vides
if(isset($data['nom']) && isset($data['prenom']) && isset($data['pseudo']) && isset($data['mail']) && isset($data['pass1'], $data['pass2'])){
   
   if(!empty($data['nom']) && !empty($data['prenom']) && !empty($data['pseudo']) && !empty($data['mail']) && !empty($data['pass1']) && !empty($data['pass2'])){
       
	   //on appelle des fonctions pour valider le mail introduit
	   if(checkCaraEmail($data["mail"]) && checkValidateEmail($data)){

		//On vérifie que le pseudo contient au moins 5 caractères
		if(strlen($data['pseudo']) >= 5){

		//On vérifie que le mot de passe contient au moins 11 caractères
		if(strlen($data['pass1']) >= 11){
            
			//on appelle une fonction pour vérifier si le mot de passe et sa confirmation correspondent et retourner une version hashée
			if($mdp=checkPass($data["pass1"], $data['pass2'])){
				
				//on appelle des fonctions pour insérer dans la table users les infos du formulaire et les lier avec un profil
				insertUser($data, $mdp);
				insertProfile($data);
				header('Location: ../index.php?success=Vous êtes inscrit');
            
						}else{
							header('Location:../index.php?error=Les mot de passe ne corresponde pas');
							}
						} else{
							header('Location:../index.php?error=Mot de passe trop court');
					}
							} else{
								header('Location:../index.php?error=Pseudo trop court');
						}
					}else{
						header('Location:../index.php?error=Format Email invalide');
						}
				}else{
					header('Location:../index.php?error=Un des champs requis est vide');
					}
			}else{
				header('Location:../index.php?error=Bien essayé');
				}

?>

