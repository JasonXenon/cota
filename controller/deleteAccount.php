<?php

include("../model/delete.php");

deleteUser($_POST["pk"]);

header("Location: ../controller/unlog.php");

?>