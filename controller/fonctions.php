<?php

//penser à ajouter une fonction qui valide les mail avec FILTER_SANITIZE_EMAIL pour éviter les caractères illégaux

//pour vérifier si le mail est valide par rapport au standard 'RFC 822'
function checkValidateEmail($data){
	
	$error=array();
	foreach($data as $key=>$value){
		if(filter_var($value, FILTER_VALIDATE_EMAIL)){
			$error[$key]='Ce mail est pas bon !';
			}
	}
	return (!empty($error)) ? $error : false;
} 

//pour vérifier si le mail est valide par rapport à une chaine de caractères définie
function checkCaraEmail($data){
	
	$code_email = "/^[a-zA-Z0-9.-]+[@]{1}[a-zA-Z0-9.-]+[.]{1}[a-z]{2,10}$/";
	return (!preg_match($code_email, $data)) ? false : true;

}

//pour vérifier si le mot de passe et sa confirmation correspondent et retourner une version hashée
function checkPass($pass1, $pass2){
  
  if($pass1 == $pass2){
    return password_hash($pass1, PASSWORD_BCRYPT);
    }else{
	return false;
    }
}

function checkValidateDate($data){
  if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data)) {
    return true;
} else {
    return false;
}
}

/* modifier les commentaires*/
//on crée une variable $maxsize qui contient l'équivalent d'un megabyte, on crée un tableau $validExtension qui contient les extensions valides et on vérifie si la taille de l'avatar est inférieure ou égale à $maxsize (1MO)
function checkUploadSize($fileFieldName, $maxSize){

if($_FILES[$fileFieldName]['size'] <= $maxSize){
	return true;
	}else{
		return false;
		}
}	

//rendre $uploadExtension global peut-être?	
function checkUploadExtension($uploadExtension, $fileFieldName, $validExtension){

if(in_array($uploadExtension, $validExtension)){
	return true;
	}else{
		return false;
		}
}			

//rendre $uploadExtension global peut-être?			
function moveFiles($uploadExtension, $fileFieldName, $uploadPath){

$moveFile = move_uploaded_file($_FILES[$fileFieldName]['tmp_name'],$uploadPath);
	
	if($moveFile){		
		return true;
		}else{
			return false;
			}
}	


?>