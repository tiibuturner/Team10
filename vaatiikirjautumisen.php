<!DOCTYPE html>
<html>
<head>
    <title>Vaatii kirjautumisen</title>
</head>
<body>
    
<?php
session_start();

if (!isset($_SESSION["user_ok"])){
    $_SESSION["paluuosoite"]="vaatiikirjautumisen.php"; /*paluuosoitteeksi vaihdettava kuvien lisäyssivu?*/
    header("Location:kirjaudu.php");
    exit;
}

print "Tiedosto vaatiikirjautumisen.php";
?>

<p>Kirjautuminen onnistui!</p>

</body>
</html>