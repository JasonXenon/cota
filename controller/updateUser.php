<?php

include("../model/update.php");

$ancien_pseudo = $_POST['pseudo_old']; // ancien pseudo de l'utilisateur

updateUser($_POST, $_GET['pk'], $ancien_pseudo);

header("Location: ../index.php");

?>