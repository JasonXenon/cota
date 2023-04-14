<?php

session_start();
//faudra éliminer certaines variables sessions, ya pas besoin de les utiliser pour tout
?>


<?php
//est-ce qu'il est mieux d'intégrer le html avec echo ou en refermant les balises php à chaque fois?	
?>
<body style="height : 100vh; background-color :<?php echo $_SESSION['profileBackgroundColor'];?>;">


<form method ="POST" action ="..\controller\profile.php" enctype="multipart/form-data">
<figure >
    <img src="../model/avatars/<?php echo $_SESSION['profileAvatar']; ?>" width='200px' height='200px' style ="border: 3px outset goldenrod;">
</figure>
    <label for="bio">Rédigez une courte biographie</label>
    <p><textarea id="bio" name="bio" rows="5" cols="33"><?php echo $_SESSION['profileBio'];?></textarea></p>
<p><time><?php echo "Vous êtes membre depuis le : ".$_SESSION['profileCreationDate'];?></time>
</p>

	
    <input type ="file" name="avatar">
    <br><hr>
    <input type="color" id="color" name="color" value="<?php echo $_SESSION['profileBackgroundColor'];?>">
	<label for="color">Choississez une couleur</label>
    
	
<br><hr>
     <section>
        <label for="blockType">Choississez un type de showcase</label>
        <select name="blockType" id="blockType">
            <option value="none"<?php if($_SESSION['profileBlockType']=="none") echo "selected=\"selected\""; ?>>--Please choose an option--</option>
            <option value="images"<?php if($_SESSION['profileBlockType']=="images") echo "selected=\"selected\""; ?>>Images</option>
            <option value="text"<?php if($_SESSION['profileBlockType']=="text") echo "selected=\"selected\""; ?>>Texte</option>
        </select>
    </section>

    <input type ="submit" value="Update">

</form>

</body>





