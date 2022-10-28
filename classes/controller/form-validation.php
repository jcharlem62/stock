<?php
require_once "../Utils.php";


if (isset($_POST['valider'])) {
  $donnees = [$_POST['mail'], $_POST['pass']];
  $types = ["email", "pass"];
  // s'il n'y a pas d'erreurs, je vais avoir des données valides et netooyées, sinon j'aurai false
  $data = Utils::valider($donnees, $types);
  if ($data) {
    // en cas d'insertion de donnees dans la base, il faut utiliser celle de data et non pas de post
    echo "<h1>données valides</h1>";
    $userData = ModelUser::connexionSuper($data['mail']);
if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
  //validation des donnees
  $_SESSION['id'] = $userData['id'];
  $_SESSION['nom'] = $userData['nom'];
  $_SESSION['prenom'] = $userData['prenom'];
  $_SESSION['tel'] = $userData['tel'];
  $_SESSION['role'] = $userData['role'];
  header('Location: accueil.php');
} else {
  // alerte : erreur d'authentification + lien vers connexion-user.php
  ViewTemplate::alert("danger", "echec de l'authentification", "connexion-user.php");
}

  }
} else {
?>

  <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
    <div>
      <label>Nom</label>
      <input type="text" name="nom" id="nom">
      <br><br>
      <label>tel</label>
      <input type="tel" name="tel" id="tel">
      <br><br>
    </div>

    <input type="submit" name="valider" value="Valider">
  </form>

<?php
}
