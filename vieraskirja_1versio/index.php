<?php
try {
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
} catch (Exception $e) {
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vieraskirja</title>
</head>
<body>
<form action="addcomment.php" method="post" name="guest">
Nimi: <br><input type="text" name="name"><br>

Sähköposti: <br><input type="text" name="email"><br><br>
Oletko käynyt Kanta-Hämeen kansallispuistoissa?<br>
 <?php
 $tulos=mysqli_query($yhteys, "select * from checkbox");
 while ($rivi=mysqli_fetch_object($tulos)) {
 print "<input type='checkbox' name='checkbox[]' value='".$rivi->id."'>$rivi->nimi<br>";
 }
 ?><br>
Viesti:
<br>
 <textarea cols="50" name="message" rows="10"> </textarea><br><br>

<input type="submit" value="Lähetä">
<input type="reset" name="eiok" value="Tyhjennä"><br><br>
</form>
</body>
</html>
<?php 
    //Suljetaan tietokantayhteys.
    mysqli_close($yhteys);
?>
<!--https://www.slashcoding.com/create-a-simple-guestbook-using-php/-->