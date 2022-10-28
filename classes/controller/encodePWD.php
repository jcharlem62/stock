<?php
session_start();
?>
<?php

echo password_hash("Az123456!", PASSWORD_DEFAULT); //  user
echo "<br>";
echo password_hash("Az654321!", PASSWORD_DEFAULT); // super

