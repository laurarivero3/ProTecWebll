<?php
//tercer paso bloqueo de usuario
session_start();
session_unset();
session_destroy();
header("Location:./login.php");
?>