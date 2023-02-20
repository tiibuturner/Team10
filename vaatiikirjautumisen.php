<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaatii kirjautumisen</title>
</head>
<body>
    
<?php
session_start();

if (!isset($_SESSION["user_ok"])){
    $_SESSION["paluuosoite"]="vaatiikirjautumisen.php"; /*paluuosoitteeksi vaihdettava kuvien lisäyssivu?*/
    header("Location:../kirjaudu.php");
    exit;
}

print "Tiedosto vaatiikirjautumisen.php";
?>

<p>Kirjautuminen onnistui!</p>

</body>
</html>