<?php

include('../model/read.php');

session_start();

if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['log']['userNiveauID']) && $_SESSION['log']['userNiveauID'] == 1){
  // L'utilisateur est connecté et a un niveau d'accès suffisant  
} else {
    header('Location: ../index.php');
}

$data = readUserInfos();

$currentUser = readCurrentUser();

$rdv = readPendingAppointments();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/headers/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<body class="text-bg-dark">

<header class="p-3">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    <nav class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <ul class="list-unstyled d-flex flex-row justify-content-center flex-wrap align-items-center">
              <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-secondary"><img src="images/cota-logo.png" class="rounded-circle align-self-center" alt="Logo de CoTa" width="60" height="auto"></a></li>
              <li class="nav-item"><a href="calendar.php" class="nav-link px-2 text-white">Rendez-vous</a></li>
              <li class="nav-item"><a href="galerie.php" class="nav-link px-2 text-white">Galerie</a></li>
              <li class="nav-item"><a href="team.php" class="nav-link px-2 text-white">Notre staff</a></li>
              <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-white">Contact</a></li>
              <?php if((isset($_SESSION['log']['userNiveauID'])) && ($_SESSION['log']['userNiveauID'] == 1)){ ?>
                <li class="nav-item"><a href="view/admin.php" class="nav-link px-2 text-white">Admin</a></li>
              <?php } ?>
            </ul>
          </nav>

    
          <button <?php if(isset($_SESSION['log'])){echo "style='display:none;'";}?> type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-outline-light me-2">Se connecter</button>


          <!-- OffCanvas connexion (début) -->
        
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
  <button type="button" class="btn-close btn-close-white text-right" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
<main class="form-signin w-100 m-auto">
<form action="controller\login.php" method="post">
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
</main>
</div>
</div>

          <!-- OffCanvas connexion (fin) -->


          <button <?php if(isset($_SESSION['log'])){echo "style='display:none;'";}?> type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">S'inscrire</button>

          <!-- OffCanvas inscription (début) -->

          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            <main class="form-signin w-100 m-auto">
              <form action="../controller/inscription.php" method="post">
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
                  <label for="floatingPassword">Votre pseudo</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" name="mail" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Email">
                  <label for="floatingPassword">Votre email</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="pass1" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Mot de passe">
                  <label for="floatingPassword">Votre mot de passe</label>
                </div>
                <div class="form-floating">
                  <input type="password" name="pass2" class="form-control text-white bg-dark" id="floatingPassword" placeholder="Confirmation de votre mot de passe">
                  <label for="floatingPassword">Confirmation de votre mot de passe</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Se connecter</button>
              </form>
            </main>
            </div>
          </div>
          
          <!-- OffCanvas inscription (fin) -->

    <a href='view/profile.php'><button <?php if(!isset($_SESSION['log'])){echo "style='display:none;'";}?> class='btn btn-outline-light me-2'>Profil</button>
    </a>
         <a href='../controller/unlog.php'>
           <button <?php if(!isset($_SESSION['log'])){echo "style='display:none;'";}?> class='btn btn-outline-light me-2'>Déconnexion</button>
        </a>
        <?php if (isset($_SESSION['log'])): ?>
              <div class="d-flex justify-content-end align-items-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                  <?= $currentUser['userPseudo']; ?>
                </div>
              </div>
            <?php endif; ?>
    </div>

  </div>
</header>


<p class="h1 text-center mb-4">Liste des utilisateurs</p>
<div class="table-responsive-sm">
  <table class="table table-sm table-bordered border-white table-striped table-dark table-hover container">
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Email</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $infos) {?>
      <tr>
        <?php foreach ($infos as $key => $info) {
          if ($key != "userID"){ ?>
        <td><?= $info; ?></td>
        <?php }?>
        <?php }?>
        <td>
          <form action="updateUser.php" method="post">
              <input type="hidden" value="<?= $infos['userID']; ?>" name="pk" >
              <input type="submit" value="Modifier">
          </form>
        </td>
        <td>
        <form action="../controller/deleteUser.php" method="post">
          <input type="hidden" value="<?= $infos['userID']; ?>" name="pk" >
          <input type="submit" value="Supprimer">
        </form>
        </td>
      <?php }?>
    </tbody>
  </table>
</div>

<p class="h1 text-center">Liste des rendez-vous en attente</p>
<div class="table-responsive-sm">
  <table class="table table-bordered border-white table-striped table-dark table-hover container">
    <thead>
      <tr>
        <th scope="col">Nom de l'utilisateur</th>
        <th scope="col">Jeu</th>
        <th scope="col">Date de début</th>
        <th scope="col">Heure de début</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        $rdv = readPendingAppointments(); 
        if(count($rdv) == 0) {
            echo "<tr><td class='text-center' colspan='5'>Pas de rendez-vous en attente.</td></tr>";
        } else {
            foreach ($rdv as $appointment) {
    ?>
    <tr>
        <td><?= $appointment['rdv_pseudo']; ?></td>
        <td><?= $appointment['jeu_nom']; ?></td>
        <td><?= date('d-m-Y', strtotime($appointment['rdv_date_start'])); ?></td>
        <td>
            <?php 
                $start_time = date_create_from_format('Y-m-d H:i:s', $appointment['rdv_date_start']);
                if (date_format($start_time, 'H') == "02") {
                    echo "14:00:00";
                } else {
                    echo date_format($start_time, 'H:i:s');
                }
            ?> 
        </td>
        <td>
        <div class="d-flex justify-content-between">
            <form action="../controller/updateAppointment.php" method="post">
                <input type="hidden" value="<?= $appointment['rdv_id']; ?>" name="pk" >
                <input type="hidden" value="accept" name="status" >
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </form>
            <form action="../controller/updateAppointment.php" method="post">
                <input type="hidden" value="<?= $appointment['rdv_id']; ?>" name="pk" >
                <input type="hidden" value="refuse" name="status" >
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-times"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
<?php 
        } 
    } 
?>
</tbody>
  </table>
</div>

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <span class="mb-3 mb-md-0 text-white">&copy;Copyright Jason Levecq - <a class="link-light" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Mentions légales</a></span>
    </div>
  </footer>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mentions légales</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-bg-dark">
        <p class="text-decoration-underline"><strong>Droit d'auteur</strong></p>
        <p>Le site www.ifosup.jasonlevecq.be constitue une création protégée par le droit d'auteur. Les textes, photos et autres éléments de mon site sont protégés par le droit d'auteur. Toute copie, adaptation, traduction, arrangement, communication au public, location et autre exploitation, modification de tout ou partie de ce site sous quelle que forme et par quel que moyen que ce soit, électronique, mécanique ou autre, réalisée dans un but lucratif ou dans un cadre privé, est strictement interdit sans mon autorisation préalable .Toute infraction à ces droits entrainera des poursuites civiles ou pénales.</p>

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
        De plus, ils vous aident à naviguer entre les différentes parties du site web. Les cookies peuvent également être utilisés pour rendre le contenu d'un site web ou la publicité présente plus adaptés aux choix, goûts personnels et aux besoins du visiteur.
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





    



<script src="js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>