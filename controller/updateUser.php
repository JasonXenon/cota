<?php

include("../model/update.php");

updateUser($_POST, $_GET['pk']);

header("Location: ../index.php");