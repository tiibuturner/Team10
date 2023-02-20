<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/linneastyle.css">
    <link rel="stylesheet" href="stylegallery.css">
    <title>Galleria</title>
</head>
<body>
    <!-- headeri jossa otsikko -->
    <header class="image row"><a href="index.html"></a>
    <h1 class="headerfp">Kanta-Hämeen Kansallispuistojen kuvagalleria</h1>
    </header>
        
    <div class="main">
         
        <!-- navbarin toteutut -->
        <nav class="nav flex-column">
            
            <ul class="margin">
                <li><a href="../index.html">Etusivu</a></li>
                <li><a href="../page1.html">Torronsuo</a></li>
                <li><a href="../page2.html">Liesjärvi</a></li>
                <li><a href="../page3.html">Yleistä</a></li>
                <li><a href="../page4.php">Vieraskirja</a></li>
                <li><a href="gallery.php">Kuvagalleria</a></li>
            </ul>

        </nav>


    

        <main>
    
        <!-- luodaan section minne kuvat tulisivat ja clasi sille. -->
        <section class="gallery-links">

        <!-- Otsikko sivulle -->
        <h1 class="h1">Kuvagalleria</h1><br><br>
           
            <div class="wrapper">
                
                <div class="gallery-container">
                
                    <?php

                        // luodaan yhteys php juttuun, josta saadaan myslqi_connectioniin tarvittavat tiedot
                        include_once './dbh.inc.php';

                        //valitaan mitä haetaan ja mistä sekä missä järjestyksessä
                        $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";

                        // initillä alustetaann yhteydenottoa eli haetaan objectit prepare statementtiä varten. 
                        $stmt = mysqli_stmt_init($conn);

                        // katsotaan saadaanko prepare stmt toimimaan ja jos ei niin echotaan se, jotta tiedetään missä virhe
                        if(!mysqli_stmt_prepare($stmt, $sql)){

                            echo "SQL statement failed!"; 

                        } 
                    
                        // ja jos ongelmaa ei ole niin totutetaan stmt ja haetaan resultit
                        else{

                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                        

                            // ja resultteja haetaan niin paljon kuin niitä on eli kaikki imagen nimet gallery tablesta
                            while($row= mysqli_fetch_assoc($result)){
                            
                                // ja echotaan ne eli alkuun haetaan kuvat databaseen tallennettujen nimien avulla,
                                // jolloin kuvilla upload kansiossa on sama nimi, kuin databaseen tallentuilla tiedoilla, 
                                // jolloin ne voidaan hakea tuolta kansiosta silla nimella.
                                // Myos gallery tablesta haetaan kuvien title ja description kuvan alle riveina.

                                echo ' <a href="#">
                                <div style="background-image: url(uploads/'.$row["imgFullNameGallery"].');"></div>
                                <h3 class="al">'.$row["titleGallery"].'</h3>
                                <p class="pal">'.$row["descGallery"].'</p>
                                </a>';
                        
                        

                            }

                        }
                    

                    
                    ?>

                </div> 

            </div>

        </section>

        <section>
            <div>
                
                <!-- lomakkeelle meno galleriasta, jos haluaa lisätä galleriaan kuvia  -->
                <br><br>
                <h2>Haluatko lisätä omia kansallispuisto muistojasi kuvagalleriaamme?</h2><br>
                <p>Pääset täältä lisäämään omia kuvia kansallispuiston kuvagalleriaan. <a class="marnie" href="uploadlomake.php">Lisää kuvia</a></p>
                <p>Jos haluat jakaa meille myös muistojasi tai kommentoida Kanta-Hämeen kansallispuistoja, 
                <p>tee niin vieraskirjamme avulla. Pääset katsomaan ja kommentoimaan vieraskirjaamme täältä. <a class="marnie" href="../page4.php">Vieraskirja</a></p><br>

                <br><br>           
<?php
        
            //    echo ' <div class="gallery-upload">
            //         <form action="gallery-upload.inc.php" method="post" enctype="multipart/form-data">
            //         <input type="text" name="filename" placeholder="Tiedoston nimi..."><br><br>
            //         <input type="text" name="filetitle" placeholder="Kuvan Otsikko..."><br><br>
            //         <input type="text" name="filedesc" placeholder="Kerro kuvastasi..."><br><br>
            //         <input type="file" name="file">
            //         <button type="submit" name="submit">Upload</button>
                    


            //         </form>


            //     </div>';
?>
            
            </div>

        </section>

        </main>

    </div>

    <!-- footeri -->
    <footer class="row">

        <div style="clear: both;">

            <p class="eka">Tiina, Marika & Linnea @ 2023</p>
            <p class="toka">Kuvat © Marika Salonen</p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
</body>
</html>