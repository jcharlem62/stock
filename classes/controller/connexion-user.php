<?php
session_start();

require_once "../view/ViewUser.php";
require_once "../model/ModelUser.php";
require_once "../view/ViewTemplate.php";
require_once "../Utils.php";



if (isset($_SESSION['id'])) {
    header('Location: accueil.php');
    exit;
}


?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Connexion</title>
</head>

<body>
    <h1>page de Connexion</h1>

    <?php
    include_once "../view/ViewUser.php";
    require_once "../model/ModelUser.php";
    // page receptrice :  j'ai des données dans POST
    if (isset($_POST['connexion'])) {
        $donnees = [$_POST['mail'], $_POST['pass']];
        $types = ["email", "pass"];
        $data = Utils::valider($donnees, $types);
        
        if(!isset($data['erreurs'])){
            $userData = ModelUser::connexion($data[0]);
            // // test si user existe (userData n'est pas vide, donc == true) && il faut qu'il ait le bon mdp
            // // couple login et mdp est bon
            if ($userData && password_verify($data[1], $userData['pass'])) {
                //     // creation de la session
                $_SESSION['id'] = $userData['id'];
                $_SESSION['nom'] = $userData['nom'];
                $_SESSION['prenom'] = $userData['prenom'];
                $_SESSION['tel'] = $userData['tel'];
                $_SESSION['role'] = $userData['role'];
                header('Location: accueil.php');
            }
            // // erreur des identifiants
            else {
                ViewTemplate::alert("danger", "Erreur d'authentification", "connexion-user.php");
            }
        }
        else {
            ViewTemplate::alert("danger", $data['erreurs'], "connexion-user.php");
        }
    }
    // page emettrice
    else {
        // affichage du formulaire
        ViewUser::connexion();
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

</html>