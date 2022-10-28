<?php
session_start();
?>
<?php
$password="4A4z4E4r4&";
$hash='$2y$10$BndXVeVG5TF/03P1QVX2PeO0FOj8oCIrUfTJWq8x3eC6R6uHsTzBq';
if (password_verify($password, $hash)){
    echo "MdP vérifié: $password";
}
else echo "Erreur de MdP";

