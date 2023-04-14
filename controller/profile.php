<?php 

session_start();

include '../model/read.php';
include '../model/update.php';
include 'fonctions.php';

//on évite des risques en travaillant avec une variable interne au lieu des infos venant directement de l'HTML
$data = $_POST;
unset($_POST);

//on vérifie si les champs du formulaire existent toujours
if(isset($_FILES['avatar']) && isset($data['color']) && isset($data['bio']) && isset($data['blockType'])){
	
	//transformer en fonction plus tard
	$validOptions = ['none', 'images', 'text'];
	if(in_array($data['blockType'], $validOptions)){
		

		
		
		
	if($_FILES['avatar']['error']!==4){

	//on crée une variable $maxsize qui contient l'équivalent d'un megabyte, on crée un tableau $validExtension qui contient les extensions valides et on vérifie si la taille de l'avatar est inférieure ou égale à $maxsize (1MO)
	
	$fileFieldName = 'avatar';
	$uploadExtension = strtolower(substr(strrchr($_FILES[$fileFieldName]['name'], '.'),1));
	$maxSize = 1048576;
	$validExtension = ['jpeg', 'jpg', 'png'];
	$uploadPath ='../model/avatars/'.$_SESSION['profileID'].'.'.$uploadExtension;
	
	if(checkUploadSize($fileFieldName, $maxSize)){
		
	if(checkUploadExtension($uploadExtension, $fileFieldName, $validExtension)){
			
	if(moveFiles($uploadExtension, $fileFieldName, $uploadPath)){		
				
				updateAvatar($uploadExtension);
				updateBackgroundColor($data['color']);
				updateBlockType($data['blockType']);
				updateBio($data['bio']);
				
				$getProfInfo = readProfile($_SESSION['userPseudo']);
				foreach($getProfInfo as $key=>$value){
					$_SESSION['profileAvatar'] = $value['profileAvatar'];
					$_SESSION['profileBackgroundColor'] = $value['profileBackgroundColor'];
					$_SESSION['profileBlockType'] = $value['profileBlockType'];
					$_SESSION['profileCreationDate'] = date("d-m-Y", strtotime($value['profileCreationDate']));
					$_SESSION['profileBio'] = $value['profileBio'];
				}
				
			header('Location: ..\view\profileView.php?message=Profil mis à jour'.$_SESSION['profileBlockType']);
				
			}else{
				header('Location: ..\view\profile.php?erreur=Avatar pas upload correctement');
				}
			
			}else{
				header('Location: ..\view\profile.php?erreur=Fichier doit être jpg,jpeg ou png');
				}
			
			}else{
				 header('Location: ..\view\profile.php?erreur=Taille max de 1 MO');
				 }
		
			}else{
				
				reUpdateAvatar();
				updateBackgroundColor($data['color']);
				updateBlockType($data['blockType']);
				updateBio($data['bio']);
				
				$getProfInfo = readProfile($_SESSION['userPseudo']);
				foreach($getProfInfo as $key=>$value){
				
					$_SESSION['profileAvatar'] = $value['profileAvatar'];
					$_SESSION['profileBackgroundColor'] = $value['profileBackgroundColor'];
					$_SESSION['profileBlockType'] = $value['profileBlockType'];
					$_SESSION['profileCreationDate'] = date("d-m-Y", strtotime($value['profileCreationDate']));
					$_SESSION['profileBio'] = $value['profileBio'];
				}
				header('Location: ..\view\profileView.php?message=Profil mis à jour'.'blocktype='.$_SESSION['profileBlockType']);
				
				}
				
			}else{
				header('Location: ..\view\profile.php?erreur=nice try zebi');
				}
			
			}else{
				header('Location: ..\view\profile.php?erreur=nice try zebi');
				}

?>