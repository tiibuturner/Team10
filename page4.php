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
    <meta name="description" content="Kanta-Hämeen Kansallispuistot, Torronsuon kansallispuisto, Liesjärven kansallispuisto">
    <meta name="keywords" content="kansallispuisto, Torronsuo, Liesjärvi, Kanta-Häme">
    <meta name="author" content="Marika Salonen, Tiina Ylimäki, Linnea Laukkanen">
    <title>Kansallispuistot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/general.css">
    <link rel="stylesheet" href="assets/css/vieraskirjastyle.css">
    <style>
      .fontti1 {
            font-size: medium;
            }

      .fontti2 {
            font-size: large;
            font-weight: 600;
            }
</style>
</head>
<body>

        
<header class="image row"><a href="index.html"></a>
    
    <h1 class="headerfp">Vieraskirja</h1>
        
</header>
    
<div class="main">
    
    <nav class="nav flex-column">
        <ul class="margin">
            <li><a href="index.html">Etusivu</a></li>
            <li><a href="page1.html">Torronsuo</a></li>
            <li><a href="page2.html">Liesjärvi</a></li>
            <li><a href="page3.html">Yleistä</a></li>
            <li><a href="page4.php">Vieraskirja</a></li>
            <li><a href="kuvagalleria/gallery.php">Kuvagalleria</a></li>
            <li class="spa"><a class="spa" href="../Team10/kuvagalleria/uploadlomake.php">Lisää kuva<br>galleriaan</a></li>
        </ul>
    </nav>
      
    <script>
        function lahetaKommentti(lomake){
            var kommentti=new Object();
            /* Luodaan javascript olio ja annetaan halutut ominaisuudet. */
            kommentti.name=lomake.name.value;
            kommentti.email=lomake.email.value;
            kommentti.message=lomake.message.value;
            kommentti.kaynyt=(kaynyt0.checked==true ? 1 : 2);
            /* Muodostetaan JSON merkkijono seuraavalla lauseella */
            var jsonKommentti=JSON.stringify(kommentti);
            result.innerHTML=jsonKommentti;
            
            /* Alla luodaan http-pyyntö-olio, jolla sitten tehdään varsinainen http-pyyntö. */
            xmlhttp = new XMLHttpRequest();
            /* Alla anonyymi tapahtumankäsittelijäfunktio pyynnön tilan muutoksille: 
            Kun http-pyynnön tila muuttuu, tätä funktiota kutsutaan. Meillä tilana pyyntö (request) käsittely.*/
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200)
            /* Jos pyynnön tila on "onnistunut" (200) ja pyyntö on "valmis" (4) eli response on tullut perille.*/ {
                    document.getElementById("result").innerHTML = this.responseText;
              }
            };
            xmlhttp.open("POST", "./addcomment.php", true);
            /* Dokumentin elementin 'result' sisällöksi laitetaan KAIKKI mitä palvelinohjelma addcomment.php tulostaa.
            Pyyntö määritelty (POST) ja pyyntö lähetetään asynkronisesti (true)*/
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            /* Pyynnölle asetetaan 'Content-type' otsikkotieto "application/x-www-form-urlencoded", 
            joka tavallisessa html-lomakkeessa on automaattisesti. */
            xmlhttp.send("kommentti=" + jsonKommentti);	
            /* Aiemmin luotu Javascript olio lähetetään json-merkkijono avaimella "kommentti". */
        }
        </script>
           <div class="flexContainer;"> 
            <article style="flex-grow: 2;">
        <h2>Jätä viesti</h2>
        <p>Voit jättää meille viestin tätä kautta. Kerro mitä pidit sivuistamme sekä kuvagalleriasta.</p>
        <form id='guestbook' method=post>
        Nimi: <br><input type='text' name='name' value='' placeholder='Nimi...'><br>
        Sähköposti: <br><input type='text' name='email' value='' placeholder='Sähköposti...'><br><br>
        Oletko käynyt Kanta-Hämeen kansallispuistoissa?<br>
         <?php
         $tulos=mysqli_query($yhteys, "select * from checkbox");
         $kaynyt=0;
         while ($rivi=mysqli_fetch_object($tulos)) {
         print "<input id='kaynyt".$kaynyt."' type='radio' name='checkbox[]' value='".$rivi->id."'>$rivi->nimi<br>";
         $kaynyt++;
         }
         ?><br>
        Viesti: <br><textarea cols="50" name="message" rows="10"> </textarea><br>
        <input type='button' name='ok' value='Lähetä' onclick='lahetaKommentti(this.form);'>
        <input type="reset" name="eiok" value="Tyhjennä"><br><br>
        </form>
           <hr><br>
        <h2>Vieraskirjaan jätetyt viestit</h2>
        <br>    
        <?php
            $conn = mysqli_connect("db", "root", "password", "vieraskirja");
            $result = mysqli_query($conn, "SELECT * FROM guestbook ORDER BY id DESC");
                while ($row = mysqli_fetch_array($result)) {
                        echo "<h2 class='fontti2'>" . $row['name'] . "</h2>";
                if ($row['kaynyt'] = 2) {
                        echo "<p class='fontti1'> En ole käynyt Kanta-Hämeen kansallispuistossa. </p>";
                } else echo "<p> Olen käynyt Kanta-Hämeen kansallispuistossa. </p>";
                        echo "<p class='fontti2'>" . $row['message'] . "</p><hr>";
        }
            mysqli_close($conn);
        ?>
    </article>
    </div>
    <div class="flexContainer;">
        
        <p style="flex-grow: 1;" id='result'>
        Palaute
        </p>
    </div>
    
</div>
    
    <footer class="row">
        <div style="clear: both;">
        <p class="eka">Tiina, Marika & Linnea @ 2023</p>
        <p class="toka">Kuvat © Marika Salonen</p>
        </div>
    </footer>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>