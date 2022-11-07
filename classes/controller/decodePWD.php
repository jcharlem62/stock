<?php
session_start();
?>
<?php
$password="Az654321!";
$hash='$2y$10$rVFdOf3MzyH0mFTKvi4DY.zUPxFe.2TIJbVpnlL/OjmZCX1elqT7.';
if (password_verify($password, $hash)){
    echo "MdP vérifié: $password";
}
else echo "Erreur de MdP";

