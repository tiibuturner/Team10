<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuvien upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/linneastyle.css">
    <link rel="stylesheet" href="../kuvagalleria/stylegalleryupload.css">
    
</head>
<body>
    
    <!-- header osuus -->
    <header class="image row"><a href="../index.html"></a>

        <h1 class="headerfp">Kuvien lataaminen kuvagalleriaan</h1>

    </header>

    <main>
        
        <div class="main">
             
            <!-- navbarin laitto -->
            <nav class="nav flex-column">

                <ul class="margin">
                    <li><a href="../index.html">Etusivu</a></li>
                    <li><a href="../page1.html">Torronsuo</a></li>
                    <li><a href="../page2.html">Liesjärvi</a></li>
                    <li><a href="../page3.html">Yleistä</a></li>
                    <li><a href="../page4.php">Vieraskirja</a></li>
                    <li><a href="gallery.php">Kuvagalleria</a></li>
                    <li><a href="uploadlomake.php">Lisää kuva<br>galleriaan</a></li>
                </ul>

            </nav>

        <div class="mar wrapper">
            
            <h2 >Kuvien lataus kansallispuiston kuvagalleriaan</h2><br>

                <div class="gallery-container">
                
                <?php
                // katsotaan onko session variablet asetettu  user_ok 
                    if (isset($_SESSION["user_ok"])){
                        
                        //  jos on niin printataan tervetuoa 
                        print "<br><h2>Tervetuloa!</h2><br>";
                        ?>
                         <!-- ja vain kun sessio on käynnissä kuvien uploadaus on näkyvissä sekä uloskirjaus. -->
                        <!--  kuvien upload lomakkeen toteutus formilla sekä lopussa kirjaudu ulos nappi sekä kirjaudu ulos ehdotus. -->
                        <!-- echo ' <div class="gallery-upload"> -->
                        <div class="gallery-upload">
                    
                            <form action="gallery-upload.inc.php" method="post" enctype="multipart/form-data">

                                <input type="text" name="filename" placeholder="Tiedoston nimi..." required oninvalid="this.setCustomValidity('Tiedoston nimi puuttuu. Täytä kenttä.')" oninput="this.setCustomValidity('')" ><br><br>
                                <input type="text" name="filetitle" placeholder="Kuvan Otsikko..." required oninvalid="this.setCustomValidity('Kuvan otsikko puuttuu. Täytä kenttä.')" oninput="this.setCustomValidity('')"><br><br>
                                <input type="text" name="filedesc" placeholder="Kerro kuvastasi..." required oninvalid="this.setCustomValidity('Kuvan kuvaus puuttuu. Täytä kenttä.')" oninput="this.setCustomValidity('')"><br><br>
                                <input type="file" name="file" required oninvalid="this.setCustomValidity('Et ole valinnut kuvaa. Valitse kuva, jonka haluat ladata galleriaan.')">
                                <button type="submit" name="submit" >Upload</button>

                            </form>
                        
                            </div>
                        <!-- </div>'; -->
                        <?php
                        print "<br><hr><br><a class='marnie' href='kirjauduulos.php'>Kirjaudu ulos</a> <br><br>";
                        print "Muista myös kirjautua ulos kun olet ladannut kuvat.<br><br>";

                    // Jos ei ole kirjautuneena upload lomake ei siis näy 
                    // ja tulostuu vain kirjautumiseen tai rekisteröitymiseen pääsy. Nämä eivät näy jos on sisään kirjautunut.
                    } else {
                        print "<br>Et ole vielä kirjautuneena. Päästäksesi lataamaan kuvia kuvagalleriaamme, sinun tulee olla kirjautuneena. Pääset kirjautumaan sisään täältä. <a class='marnie' href='../kirjaudu.php'>Kirjaudu sisään</a>";
                        print "<br><br>";
                        print "Sinulta ei löydy vielä tunnuksia, joilla kirjautua sisään? Jos haluat luoda tunnukset, joilla voit kirjautua sisään, niin pääset rekisteröintiin täältä. <a class='marnie' href='../rekisteroityminen.html'>Rekisteröidy</a>";
                        print "<br><br>";
                        
                    }


                ?>

                </div>
        
                </div>

        </div>
    
    </main>

    <!-- footer osa -->
    <footer class="row">

        <div style="clear: both;">

            <p class="eka">Tiina, Marika & Linnea @ 2023</p>
            <p class="toka">Kuvat © Marika Salonen</p>

        </div>

    </footer>
    <!-- bootstapin koodi juttu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 
</body>
</html>