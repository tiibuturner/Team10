<?php
session_start();
unset($_SESSION["user_ok"]);
// header("Location:kirjauduajax.html");
header("Location:gallery.php");
?>
?>