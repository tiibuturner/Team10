<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/general.css">
    <link rel="stylesheet" href="assets/css/kirjauduyms.css">
    <title>Document</title>
    <title>Vaatii kirjautumisen</title>
</head>
<body>
  
<?php
print "<h2 class='otsikko'>Kirjaudu</h2>";
?>

<form action="tarkistakirjautuminen.php" method="post">
Tunnus:<br> <input type="text" name="tunnus" value="" size="25" ><br><br>
Salasana:<br> <input type="password" name="salasana" value="" size="25" ><br><br>
<input type="submit" name="ok" value="OK"><br>
</form>
</body>
</html>