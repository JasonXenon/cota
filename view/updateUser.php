<?php


session_start();


  if(isset($_SESSION['log']['userNiveauID']) && isset($_POST['pk'])){
    // L'utilisateur est connecté, a cliqué sur le bouton de modification et a accédé à la page via le formulaire
    // Afficher le contenu de la page ici
  } else if(isset($_SESSION['log']['userNiveauID'])){
    // L'utilisateur est connecté mais n'a pas accédé à la page via le formulaire
    header('Location: ../index.php'); // Rediriger l'utilisateur vers la page d'accueil
  } else {
    // L'utilisateur n'est pas connecté
    header('Location: ../index.php'); // Rediriger l'utilisateur vers la page d'accueil
  }



include ('../model/read.php');

$data = readUserPk($_POST['pk']);

$jeux = readGame();

$pseudoByRdv = readRdvAndJeuInfos();

$pseudoByUser = readCurrentUser();

if (isset($_SESSION['log']['userID'])) {
    // Lire les rendez-vous de l'utilisateur connecté
    $rdvs = readRdvs($_SESSION['log']['userID']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoTa · Modification de profil</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body class="text-bg-dark">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="../controller/updateUser.php?pk=<?= $_POST["pk"] ?>" method="post">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" value=<?= $data["userNom"]; ?> >
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prénom" value=<?= $data["userPrenom"]; ?> >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="mail" class="form-control" id="email" placeholder="Email" value=<?= $data["userEmail"]; ?> >
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Entrez votre pseudo" value=<?= $data["userPseudo"]; ?> >
                        <input type="hidden" name="pseudo_old" class="form-control" id="pseudo" placeholder="Entrez votre pseudo" value=<?= $data["userPseudo"]; ?> >
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary me-auto">Modifier</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer le compte</button>
                    </div>
                </form>


                <!-- Modal de suppression de compte -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header text-bg-dark">
                        <h5 class="modal-title" id="exampleModalLabel">Supprimer votre compte</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-bg-dark">
                        Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.
                    </div>
                    <div class="modal-footer text-bg-dark">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Annuler</button>
                        <form action="../controller/deleteAccount.php?pk=<?= $_POST["pk"] ?>" method="post">
                            <input type="hidden" value=<?= $data["userID"]; ?> name="pk" >
                            <button type="submit" class="btn btn-outline-danger">Oui, supprimer le compte</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>

                <a href="../index.php" class="position-fixed top-0 start-0 mt-3 ms-3 text-white" style="font-size: 2rem;"><i class="bi bi-arrow-left-circle"></i></a>
            </div>
        </div>

        <?php 
        if(isset($pseudoByUser['userPseudo']) && isset($_POST['user_form'])) { // Vérifier si un utilisateur est connecté en vérifiant la présence de la variable de session 'user_id' et s'il vient du formulaire 'user_form'
    ?>
<div class="container mt-5">
    <p class="h2 mb-4">Mes rendez-vous :</p>
    <?php if ($rdvs): ?>
        <table class="table table-hover table-dark table-responsive">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Jeu</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rdvs as $rdv): ?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($rdv['rdv_date_start'])); ?></td>
                        <td><?php 
                            $start_time = date_create_from_format('Y-m-d H:i:s', $rdv['rdv_date_start']);
                            if (date_format($start_time, 'H') == "02") {
                                echo "14:00:00";
                            } else {
                                echo date_format($start_time, 'H:i:s');
                            } ?></td>
                        <td><?= $rdv['jeu_nom']; ?></td>
                        <td><?= $rdv['confirmation_status']; ?></td>
                        <td>
                            <?php if ($rdv['confirmation_status'] != 'Accepté'): ?>
                                <form method="post" action="../controller/updateAppointment.php">
                                    <input type="hidden" name="pk" value="<?= $rdv['rdv_id']; ?>">
                                    <input type="hidden" value="cancel" name="status" >
                                    <button type="submit" class="btn btn-danger">Annuler</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun rendez-vous à afficher.</p>
    <?php endif; ?>
</div>
<?php 
    } // Fermer la condition pour vérifier si un utilisateur est connecté et s'il vient du formulaire 'user_form'
?> 










    </div>

    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>


</body>
</html>