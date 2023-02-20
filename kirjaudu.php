<!DOCTYPE html>
<html>
<head>
    <title>Vaatii kirjautumisen</title>
</head>
<body>
  
<?php
print "<h2>Kirjaudu</h2>";
?>

<form action="tarkistakirjautuminen.php" method="post">
Tunnus:<br> <input type="text" name="tunnus" value="" size="25" required oninvalid="this.setCustomValidity('Et kirjoittanut tunnustasi. Tunnuksesi tähän.')"><br><br>
Salasana:<br> <input type="password" name="salasana" value="" size="25" required oninvalid="this.setCustomValidity('Et kirjoittanut salasanaasi. Kirjoita salasanasi tähän')"><br><br>
<input type="submit" name="ok" value="OK"><br>
</form>
</body>
</html>