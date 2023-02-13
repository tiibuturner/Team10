<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vieraskirja</title>
</head>
<body>
<form action="addcomment.php" method="post" name="guest">
Nimi: <br><input type="text" name="name">

Sähköposti: <br><input type="text" name="email">
Oletko käynyt Kanta-Hämeen kansallispuistoissa?<br>
 <?php
 $tulos=mysqli_query($yhteys, "select * from checkbox");
 while ($rivi=mysqli_fetch_object($tulos)) {
 print "<input type='checkbox' name='checkbox[]' value='".$rivi->id."'>$rivi->nimi<br>";
 }
 ?><br>
Viesti:

 <textarea cols="50" name="message" rows="10"> </textarea>

<input type="submit" value="Lähetä"></form>
</body>
</html>
<!--https://www.slashcoding.com/create-a-simple-guestbook-using-php/-->