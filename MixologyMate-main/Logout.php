<?php
session_start(); 
session_unset(); 
session_destroy(); 

echo "Logout effettuato! <a href='login.php'>Torna al login</a>";
?>
