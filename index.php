<?php

include 'model/read.php';

session_start();
//mettre des autofocus dans les modals

if((isset($_SESSION['log']))){
  $data = readCurrentUser();
}

$success = isset($_GET['success']) ? $_GET['success'] : '';

$error = isset($_GET['error']) ? $_GET['error'] : '';

?> 

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Découvrez notre sélection de jeux pour le coaching. Prenez rendez-vous pour vous entraîner sur votre jeu favori avec nos experts. Explorez notre section 'Accueil' dès maintenant.">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>CoTa · Accueil</title>
    <link href="view/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="website icon" type="images/png" sizes="196x196" href="view/images/cota-logo.png">
  </head>


  <body class="text-bg-dark">

  <div class="alert alert-warning alert-dismissible fade show sticky-top  " role="alert">
    Notre site utilise des cookies pour améliorer votre expérience utilisateur. En continuant à naviguer sur notre site, vous acceptez notre politique en matière de cookies.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <?php if (!empty($success)): ?>
    <!-- Afficher le message dans une alerte Bootstrap -->
    <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($success); ?>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <!-- Afficher le message dans une alerte Bootstrap -->
    <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>






  <!-- Header (début) -->

  <header class="p-3">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <!-- Nav (début) -->
          <nav class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <ul class="list-unstyled d-flex flex-row justify-content-center flex-wrap align-items-center">
              <li class="nav-item"><a href="index.php" class="nav-link px-2 text-secondary"><img src="view/images/cota-logo.png" class="rounded-circle align-self-center" alt="Logo de CoTa" width="60" height="auto"></a></li>
              <li class="nav-item"><a href="view/calendar.php" class="nav-link px-2 text-white">Rendez-vous</a></li>
              <li class="nav-item"><a href="view/galerie.php" class="nav-link px-2 text-white">Galerie</a></li>
              <li class="nav-item"><a href="view/team.php" class="nav-link px-2 text-white">Notre staff</a></li>
              <li class="nav-item"><a href="view/contact.php" class="nav-link px-2 text-white">Contact</a></li>
              <?php if((isset($_SESSION['log']['userNiveauID'])) && ($_SESSION['log']['userNiveauID'] == 1)){ ?>
                <li class="nav-item"><a href="view/admin.php" class="nav-link px-2 text-white">Admin</a></li>
              <?php } ?>
            </ul>
          </nav>


          
          <!-- Nav (fin) -->

      
            <button <?php if(isset($_SESSION['log'])){echo "style='display:none;'";}?> type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-outline-light me-2">Se connecter</button>
            <button <?php if(isset($_SESSION['log'])){echo "style='display:none;'";}?> type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">S'inscrire</button>

            <!-- OffCanvas connexion (début) -->
          
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header">
                <button type="button" class="btn-close btn-close-white text-right" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
              <section class="form-signin w-100 m-auto">
              <form action="controller/login.php" method="post">
                <h2 class="h3 mb-3 fw-normal text-white text-center">Connectez-vous !</h2>

                <div class="form-floating mb-2">
                  <input type="text" name="pseudo" class="form-control text-white bg-dark" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Votre pseudo</label>
                </div>
                <div class="form-floating">
                  <input type="password" name="pass" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">Mot de passe</label>
                </div>
                <button class="w-100 btn btn-lg btn-warning mt-3" type="submit">Se connecter</button>
              </form>
            </section>
              </div>
            </div>

            <!-- OffCanvas connexion (fin) -->

            <!-- OffCanvas inscription (début) -->

            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>  
              <div class="offcanvas-body">
              <section class="form-signin w-100 m-auto">
                <form action="controller/inscription.php" method="post" id="inscriptionForm">
                  <h2 class="h3 mb-3 fw-normal text-white text-center">Inscrivez-vous !</h2>

                  <div class="form-floating mb-3">
                    <input type="text" name="nom" class="form-control text-white bg-dark" id="floatingInput" placeholder="Nomm">
                    <label for="floatingInput">Votre nom</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="prenom" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Prenom">
                    <label for="floatingPassword">Votre prénom</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="pseudo" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Pseudo">
                    <small></small>
                    <label for="floatingPassword">Votre pseudo</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="mail" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Email">
                    <small></small>
                    <label for="floatingPassword">Votre email</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" name="pass1" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Mot de passe">
                    <small></small>
                    <label for="floatingPassword">Votre mot de passe</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" name="pass2" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Confirmation de votre mot de passe">
                    <label for="floatingPassword">Confirmation de votre mot de passe</label>
                  </div>
                  <p id="password-match"></p>
                  <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">S'inscrire</button>
                </form>
              </section>
              </div>
            </div>
            
            <!-- OffCanvas inscription (fin) -->

            <!-- Bouton Modifier -->            
            
            <form action="view/updateUser.php" method="post">
              <input type="hidden" value="<?= $data['userID']; ?>" name="pk" >
              <input type="hidden" name="user_form">
              <input <?php if(!isset($_SESSION['log'])){echo "style='display:none;'";}?> type="submit" class="btn btn-outline-light me-2" value="Modifier mes données">
            </form>

            <!-- Bouton Déconnxion -->

            <a href='controller/unlog.php'>
             <button <?php if(!isset($_SESSION['log'])){echo "style='display:none;'";}?> class='btn btn-outline-light me-2'>Déconnexion</button>
            </a>

            <?php if (isset($_SESSION['log'])): 
            $userPseudo = $data['userPseudo'];
            $pseudoLength = strlen($userPseudo);
            $minWidth = 20; // La largeur minimale pour le rectangle
            $maxWidth = 200; // La largeur maximale pour le rectangle
            $charWidth = 10; // La largeur approximative de chaque caractère
            $rectangleWidth = $minWidth + ($charWidth * $pseudoLength); // Largeur initiale du rectangle
            if ($rectangleWidth > $maxWidth) {
              $rectangleWidth = $maxWidth;
            }
            $rectangleHeight = 40; // Hauteur du rectangle, dans cet exemple, la hauteur est fixe à 40px
            
          ?>
            <div class="d-flex justify-content-end align-items-center">
              <div class="rounded bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: <?= $rectangleWidth ?>px; height: <?= $rectangleHeight ?>px; padding: <?= ($rectangleHeight - 30)/2 ?>px;">
                <?= $userPseudo; ?>
              </div>
            </div>
          <?php endif; ?>


      </div>


      <!-- Affiche le nombre de rendez-vous en attente (si admin) -->


      <?php if((isset($_SESSION['log']['userNiveauID'] )) && ($_SESSION['log']['userNiveauID'] == 1)){ 
            if(readPendingAppointmentsCount() > 0) {
                echo '<div class="d-flex justify-content-end mt-3">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body text-black">
                        Il y a ' . readPendingAppointmentsCount(). ' rendez-vous en attente de confirmation.
                        <div class="mt-2 pt-2 border-top">
                        <a href="view/admin.php">
                          <button type="button" class="btn btn-primary btn-sm">Voir les rendez-vous</button>
                        </a>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>';
            } else {
                echo '<div class="d-flex justify-content-end mt-3">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body text-black">
                        Aucun rendez-vous en attente actuellement.
                    </div>
                </div>
            </div>';
            }
    }?>
  </header>

  <!-- Header (fin) -->

  <!-- Section Rainbow Six : Siege -->
<main>
  <figure class="container pt-3">
  <div class="row bg-secondary bg-opacity-25 d-flex align-items-center">
    <div class="col-12 col-md-8 p-2">
      <img src="view\images\R6\SI2021_RoadToSI_keyart.jpg" class="img-fluid border border-4 border-success" alt="Championnat du monde de Rainbow six: Siege">
    </div>
    <article class="col-12 col-md-4 d-flex flex-column justify-content-center">
      <h2 class="text-center mb-4">Rainbow Six: Siege</h2>
      <p class="pt-2">Vous voulez améliorer votre jeu et devenir un véritable <span class="fw-bold">pro de Rainbow Six: Siege</span> ? Nos coachs professionnels sont là pour vous aider à atteindre vos objectifs ! Avec leurs années d'expérience et leurs compétences exceptionnelles, ils peuvent vous fournir des conseils personnalisés et des astuces pratiques pour améliorer votre stratégie, votre jeu d'équipe et vos compétences individuelles. Prenez rendez-vous dès maintenant pour un coaching personnalisé et devenez le meilleur joueur de Rainbow Six: Siege que vous pouvez être !</p>
      <div class="h-auto pt-5 d-flex justify-content-center">
        <a href="view/calendar.php">
          <button class="btn btn-primary" type="submit">Prendre rendez-vous</button>
        </a>
      </div>
    </article>
  </div>
</figure>




  <div class="container d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-1 border-bottom"></div>


  <!-- section Valorant -->

  
  <figure class="container pt-2">
  <div class="row bg-secondary bg-opacity-25 align-items-center">
    <article class="col-12 col-md-6">
      <h2 class="text-center mb-4">Valorant</h2>
      <p class="pt-2">Vous souhaitez monter en grade et atteindre <span class="fw-bold">le sommet de la compétition dans Valorant</span> ? Avec l'aide de nos coachs professionnels, vous pouvez améliorer votre jeu, perfectionner votre stratégie et atteindre de nouveaux niveaux de compétence. Réservez dès maintenant votre session de coaching personnalisée et obtenez les conseils avisés d'un professionnel pour prendre une longueur d'avance sur vos adversaires.</p>
      <div class="h-auto pt-5 d-flex justify-content-center">
        <a href="view/calendar.php">
          <button class="btn btn-primary" type="submit">Prendre rendez-vous</button>
        </a>
      </div>
    </article>
    <div class="col-12 col-md-6">
      <img src="view\images\Valorant\V_Logotype_Off-White.png" class="img-fluid" alt="Valorant, un jeu developper par Riot Games">
    </div>
  </div>
</figure>


  <div class="container d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-1 border-bottom"></div>

  <!-- Section Counter Strike : Global Offensive -->

<figure class="container pt-3">
  <div class="row bg-secondary bg-opacity-25 d-flex align-items-center">
    <div class="col-12 col-md-8 p-2">
      <img src="view\images\CSGO\counter_strike.jpg" class="img-fluid border border-4 border-success" alt="Counter Strike : Global Offensive, un jeu de tir à la première personne">
    </div>
    <article class="col-12 col-md-4">
    <h2 class="text-center mb-4">Counter Strike : Global Offensive</h2>
      <p class="pt-2">Vous êtes un joueur passionné de Counter Strike: Global Offensive et vous voulez améliorer vos compétences pour devenir un joueur pro ? Nos coachs professionnels sont là pour vous aider à atteindre votre potentiel maximum. Avec des années d'expérience dans l'industrie du jeu vidéo, nos coachs peuvent vous aider à développer vos compétences de jeu, à améliorer votre stratégie et à optimiser votre gameplay. Prenez rendez-vous dès maintenant pour un coaching personnalisé et découvrez comment vous pouvez devenir un <span class="fw-bold">joueur d'élite dans le monde de CS:GO</span></p>
      <div class="h-auto pt-5">
        <a href="view/calendar.php">
          <button class="btn btn-primary d-block mx-auto" type="submit">Prendre rendez-vous</button>
        </a>
      </div>
    </article>
  </div>
</figure>
</main>

<!-- Footer -->

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex justify-content-start">
      <span class="mb-3 mb-md-0 text-white">&copy;Copyright Jason Levecq - <a class="link-light text-decoration-underline" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Mentions légales</a></span>
    </div>
    <div class="col-md-4 d-flex justify-content-end">
      <span class="mb-3 mb-md-0 text-white"><a class="link-light text-decoration-underline" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal3">Conditions d'utilisation</a></span>
    </div>
  </footer>
</div>

<!-- Modal mentions légales -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h3 class="modal-title fs-5 h1" id="exampleModalLabel">Mentions légales</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-bg-dark">
        <h3 class="h1 fw-bold text-center text-uppercase m-3">Mentions légales</h3>
        <p class="text-decoration-underline"><strong>Droit d'auteur</strong></p>
        <p>Le site www.ifosup.jasonlevecq.be constitue une création protégée par le droit d'auteur. Les textes, photos et autres éléments de mon site sont protégés par le droit d'auteur. Toute copie, adaptation, traduction, arrangement, communication au public, location et autres exploitation, modification de tout ou partie de ce site sous quelque forme et par quelque moyen que ce soit, électronique, mécanique ou autre, réalisée dans un but lucratif ou dans un cadre privé, est strictement interdit sans mon autorisation préalable. Toute infraction à ces droits entrainera des poursuites civiles ou pénales.</p>

        <p class="text-decoration-underline"><strong>Marques et noms commerciaux</strong></p>
        <p>Les dénominations, logos et autres signes utilisés sur mon site sont des marques et/ou noms commerciaux légalement protégés. Tout usage de ceux-ci ou de signes ressemblants est strictement interdit sans un accord préalable et écrit.</p>

        <p class="text-decoration-underline"><strong>Responsabilité quant au contenu</strong></p>
        <p>J'apporte le plus grand soin à la création et à la mise à jour de ce site mais je ne peux toutefois pas garantir l'exactitude de l'information qui s'y trouve. Les informations contenues dans ce site pourront faire l'objet de modifications sans préavis. Les informations données sur ce site ne sauraient engager ma responsabilité, je ne pourrais être tenu pour responsable de toute omission, erreur ou lacune qui aurait pu se glisser dans ses pages ainsi que des conséquences, quelles qu'elles soient, pouvant résulter de l'utilisation des informations et indications fournies.</p>

        <p class="text-decoration-underline"><strong>Coordonnées</strong></p>
        <p>Vous pouvez me contacter par Email à jason.levecq@ifosup.wavre.be</p>

        <p class="text-decoration-underline"><strong>Hébergeur</strong></p>
        <p>OVH</p>
        <p>2 rue Kellermann</p>
        <p>59100 Roubaix - France.</p>
        <p>www.ovh.com</p>

        <p class="text-decoration-underline"><strong>Cookies</strong></p>
        <p><strong>Définition d'un cookies</strong></p>
        <p>Un cookie est un fichier texte déposé sur le disque dur de votre ordinateur, de votre appareil mobile ou de votre tablette lors de la visite d'un site ou de la consultation d'une publicité. Il a pour but de collecter des informations relatives à votre navigation et de vous adresser des services adaptés à votre terminal.
        Le cookie contient un code unique permettant de reconnaître votre navigateur lors de votre visite sur le site web ou lors de futures visites répétées. Les cookies peuvent être placés par le serveur du site web que vous visitez ou par des partenaires avec lesquels ce site web collabore. Le serveur d'un site web peut uniquement lire les cookies qu'il a lui-même placés et n'a accès à aucune autre information se trouvant sur votre ordinateur ou sur votre appareil mobile.
        Les cookies assurent une interaction généralement plus aisée et plus rapide entre le visiteur et le site web. En effet, ils mémorisent vos préférences (la langue choisie ou un format de lecture par exemple) et vous permettent ainsi d'accélérer vos accès ultérieurs au site et de faciliter vos visites.
        De plus, ils vous aident à naviguer entre les différentes parties du site web. Les cookies peuvent également être utilisés pour rendre le contenu d'un site web ou la publicité présente plus adaptés au choix, goûts personnels et aux besoins du visiteur.
        Les informations ainsi récoltées sont anonymes et ne permettent pas votre identification en tant que personne. En effet, les informations liées aux cookies ne peuvent pas être associées à un nom et/ou prénom parce qu'elles ne contiennent pas de données à caractère personnel.
        Les cookies sont gérés par votre navigateur internet. L'utilisation des cookies nécessite votre consentement préalable et explicite. Vous pourrez toujours revenir ultérieurement sur celui-ci et refuser ces cookies et/ou les supprimer à tout moment, en modifiant les paramètres de votre navigateur.</p>

        <p class="text-decoration-underline"><strong>Autoriser ou bloquer les cookies ?</strong></p>
        <p>La plupart des navigateurs internet sont automatiquement configurés pour accepter les cookies. Cependant, vous pouvez configurer votre navigateur afin d'accepter ou de bloquer les cookies.</p>
        <p>Je ne peux cependant vous garantir l'accès à tous les services de mon site internet en cas de refus d'enregistrement de cookies.</p>
      </div>
      <div class="modal-footer text-bg-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal conditions d'utilisation -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h3 class="modal-title fs-5 h1" id="exampleModalLabel">Conditions d'utilisation</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-bg-dark">
      <h3 class="h1 fw-bold text-center text-uppercase m-3">Conditions d'utilisation</h3>
        <p>En accédant à ce site web, vous acceptez de vous conformer à ces conditions d'utilisation. Si vous n'êtes pas d'accord avec ces conditions, veuillez ne pas utiliser ce site.</p>

        <p class="text-decoration-underline"><strong>Propriété intellectuelle</strong></p>
        <p>Le contenu de ce site web, y compris les textes, images, graphiques, logos, noms de marques, est protégé par des droits d'auteur et autres droits de propriété intellectuelle. Vous ne pouvez pas copier, reproduire, publier, afficher, distribuer, modifier ou utiliser le contenu de ce site web sans notre autorisation préalable écrite.</p>

        <p class="text-decoration-underline"><strong>Utilisation du site</strong></p>
        <p>Vous vous engagez à utiliser ce site web uniquement à des fins légales et conformément aux lois et réglementations applicables. Vous ne pouvez pas utiliser ce site web pour publier, transmettre ou distribuer du contenu illégal, diffamatoire, obscène, menaçant, injurieux ou discriminatoire.</p>

        <p class="text-decoration-underline"><strong>Protection des données personnelles</strong></p>
        <p>Nous prenons la protection de vos données personnelles très au sérieux. Toutes les données collectées sur ce site web seront traitées conformément à notre politique de confidentialité.</p>

        <p class="text-decoration-underline"><strong>Limitation de responsabilité</strong></p>
        <p>Nous nous efforçons de maintenir les informations de ce site web à jour et exactes. Cependant, nous ne pouvons pas garantir l'exactitude, l'exhaustivité ou l'actualité de ces informations. Nous déclinons toute responsabilité pour tout dommage direct ou indirect résultant de l'utilisation de ce site web.</p>

        <p class="text-decoration-underline"><strong>Liens vers des sites tiers</strong></p>
        <p>Ce site web peut contenir des liens vers des sites web de tiers. Nous ne sommes pas responsables de la disponibilité, du contenu ou de l'exactitude de ces sites web tiers. L'insertion de ses liens ne signifie pas que nous approuvons les sites web liés ou leur contenu.</p>

        <p class="text-decoration-underline"><strong>Modification des conditions d'utilisation</strong></p>
        <p>Nous nous réservons le droit de modifier ces conditions d'utilisation à tout moment et sans préavis. Veuillez consulter régulièrement cette page pour vous tenir informé des mises à jour.</p>

        <p class="text-decoration-underline"><strong>Loi applicable et juridiction compétente</strong></p>
        <p>Ces conditions d'utilisation sont régies par la loi belge. Tout litige découlant de ces conditions d'utilisation sera soumis à la juridiction exclusive des tribunaux belges.</p>
      </div>
      <div class="modal-footer text-bg-dark">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>




<script src="view/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="view\js\script.js"></script>


</body>
</html>
