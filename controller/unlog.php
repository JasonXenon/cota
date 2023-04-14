<?php

session_start();
session_unset();
session_destroy();
header('Location: ../index.php?message=En espérant vous revoir très vite !');

?>