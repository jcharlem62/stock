<?php
  require_once "connexion.php";
  
class ModelUser
{

  public static function connexionSuper($mail)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
      SELECT * FROM user WHERE mail=:mail and role = 'super'
    ");

    $requete->execute(
      [
        ':mail' => $mail,
      ]
    );
    return $requete->fetch(PDO::FETCH_ASSOC);
  }

  public static function connexion($mail)
  {
    $idcon = connexion();
    $requete = $idcon->prepare("
      SELECT * FROM user WHERE mail=:mail and role != 'super'
    ");

    $requete->execute(
      [
        ':mail' => $mail,
      ]
    );
    return $requete->fetch(PDO::FETCH_ASSOC);
  }
}
