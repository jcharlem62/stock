<?php
session_start();
?>
<?php

echo password_hash("Charlem&gne", PASSWORD_DEFAULT);

// je cherche à génerer un hash pour l'insérer dans la bdd
// dans la bdd, le pass doit etre hashé

// récupérer les donnes de la base en fonction du mail

