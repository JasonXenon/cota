<?php

session_start();

include '../model/connection.php';
include '../model/insert.php';
include '../model/read.php';
include 'fonctions.php';

$user = readPseudo($_POST['pseudo']);
$today = date("Y-m-d");


$data = $_POST;
unset($_POST);

if(isset($data['date']) && isset($data['jeu']) && isset($data['moment'])){
    if(!empty($data['date']) && !empty($data['jeu']) && !empty($data['moment'])){
        if($_SESSION['userPseudo'] == $user['userPseudo']){ //verification que le pseudo stoclé dans la session est le meme que dans le form
            if($today < $data['date']){ // verification que l'utilisateurs à demaindé un rendez-vous dans + de 24h
if (checkValidateDate($data["date"])) {
    $matinDebut = date("h:i:s", strtotime("08:00:00"));
    $matinFin = date("h:i:s", strtotime("12:00:00"));
    $apremDebut = date("h:i:s", strtotime("14:00:00"));
    $apremFin = date("h:i:s", strtotime("18:00:00"));

    if ($data['moment']=="matin") {
        $debut = $matinDebut;
        $fin = $matinFin;
    } else {
        $debut = $apremDebut;
        $fin = $apremFin;
    }

    $rdvStart = date("Y-m-d h:i:s", strtotime($data['date'].$debut));
    $rdvFin = date("Y-m-d h:i:s", strtotime($data['date'].$fin));
        insertRdv($data, $rdvStart, $rdvFin);
        header('Location: ../index.php?success=Votre rendez-vous à bien été enregistré&warning=Attention ! Ce n\'est pas parce que votre rendez-vous a bien été pris que celui-ci est validé. Un administateur du site vous contactera pour valider votre rendez-vous.');
}
    else {
            header('Location: ../index.php?error=Le format de date n\'est pas valide');
            }
        } else {
            header('Location: ../index.php?error=Veuillez renseigner une date future');
        }
        } else {
            header('Location: ../index.php?error=L\'usurpation est passible de beaucoup de soucis !');
        }
    } else {
        header ('Location: ../index.php?error=Un des champs requis est vide');
    }
} else{
     header('Location: ../index.php?error=Bien essayé');
}

?>