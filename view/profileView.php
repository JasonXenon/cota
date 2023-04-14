<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfileView</title>
</head>
<body style="height : 100vh; background-color :<?php echo $_SESSION['profileBackgroundColor'];?>;">
  
<figure >
    <img src="../model/avatars/<?php echo $_SESSION['profileAvatar']; ?>" width='200px' height='200px' style ="border: 3px outset goldenrod;">
</figure>
<p><?php echo $_SESSION['profileBio'];?></p>
<p>
    <time><?php echo "Vous êtes membre depuis le : ".$_SESSION['profileCreationDate'];?></time>
</p>

<p><a href="profile.php">Éditer le profil</a></p>





</body>
</html>
