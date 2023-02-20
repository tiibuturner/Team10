<?php
    // Luetaan lomakkeelta tulleet tiedot, jos ne olemassa.
    if (isset($_POST['submit'])) {

        // jos tiedoista löytyy nimi se syötetään tietokantaan
        $newFileName = $_POST['filename'];

            // jos nimen tietoa ei ole merkitty sille annetaan nimi gallery
            if (empty($newFileName)){

                $newFileName = "gallery";
        
            // ja jos tieto löytyi se muunnetaan sopivaan muotoon ja siitä poistetaan turhat välit tai väliviivat
            } else {

                $newFileName = strtolower(str_replace(" ", "-", $newFileName));

            }
    

        // koska imagen otsikko tai lisätiedot muuttujiksi
        $imageTitle = $_POST['filetitle'];
        $imageDesc = $_POST['filedesc'];
        
        // filetyyppi omaksi muuttujakseen
        $file = $_FILES['file'];
        
        //"fileen" muuttujat ja niiden arvot (file nimi, tyyppi, väliaikainen nimi, error ja fileen koko) 
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileTempName = $file["tmp_name"];
        $fileError = $file["error"];
        $fileSize = $file["size"];

        // expoadataan filen nimi string arrayksi
        $fileExt = explode(".", $fileName);
        //  otetaan arraysta vaan loppu osio, eli pieni lyhennys varmuudeksi endil 
        $fileActualExt = strtolower(end($fileExt));

        // array mahdollisista file tyypeistä
        $allowed = array("jpg", "jpeg", "png");

            // katotaan onko fileessä haluttu file tyyppi
            if (in_array($fileActualExt, $allowed)) {

                // jos ei löydy erroreita niin jatketaan
                if($fileError === 0){

                    // katsotaan, onko file sopivan kokoinen
                    if($fileSize < 6000000){

                        // jos tsekkaukset menneet läpi niin tehdään imagelle sen lopullinen nimi, joka pakolla uniikki
                        $imageFullName = $newFileName . "." . uniqid("", true,) . "." . $fileActualExt;
                        // ja määrätään missä fileen lopullinen siirtopaikka on sen tosinimellä
                        $fileDestination = "uploads/" . $imageFullName;

                        // includetaan kerran stmt:iin tarvittavat tiedot php filestä
                        include_once "dbh.inc.php";

                            // jos title tai lisätiedot on tyhjät niin
                            if (empty($imageTitle) || empty($imageDesc)) {

                                print 'Et täyttänyt kuvan otsikkoa tai lisätietoja kuvalle.';
                                header("Location: gallery.php?upload=empty");
                                exit();

                            // Muuten voidaan jatkaa eteenpäin 
                            }else{

                                // valitaan kaikki gallery taulusta
                                $sql = "SELECT * FROM gallery;";
                                $stmt = mysqli_stmt_init($conn);

                                    // jos prepare statement epäonnistuu niin se kerrotaan
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        
                                        echo "SQL statement failed!";
                                    
                                    // jos ei niin jatketaan eteenpäin
                                    }else{
                                        
                                        // ruvetaan toteuttamaan stmt
                                        mysqli_stmt_execute($stmt);

                                        // haetaan resultit (select * from gallery)
                                        $result = mysqli_stmt_get_result($stmt);

                                        // luetaan gallery tablen sisältämien tietojen rivien määrät
                                        $rowCount = mysqli_num_rows($result);

                                        // luodaan imagelle order numero galleria taulun sen hetkisten rivien määrästä + 1
                                        $setImageOrder = $rowCount +1;

                                        // käsketään insertoimaan uuden kuvan tiedot galleryyn
                                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);";
                                            
                                            // jos stmt epäonnistui kerrotaan, että yhteyttä ei saatu
                                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                                
                                                
                                                echo "Tapahtui jokin virhe!";
                                                
                                            // muuten jatketaan stmt:tiä
                                            }else{
                                                
                                                mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                                                mysqli_stmt_execute($stmt);

                                                // siirretään uploadattu file oikeaan paikkaan
                                                move_uploaded_file($fileTempName, $fileDestination);

                                                // ohjataan lopuksi menemään takaisin gallery sivulle, jos kaikki onnistui
                                                header("Location: gallery.php?upload=success");
                                 
                                            }
                                    }
                            }
                    } else {
                        
                        // kerrotaan jos file on liian iso ladattavaksi
                        echo "Kuvan tiedosto on liian iso ladattavaksi!";
                        exit();
                    }

                } else {
                
                    // kerrotaan että kuvan lataamisessa tapahtui jokin virhe
                    echo "Ladattaessa kuvaa tapahtui jokin virhe ja kuvaa ei saatu ladattua galleriaan!";
                    exit();
                }
        
            } else {
                
                //Kerrotaan että lataus epäonnistui ja, että kuvatiedoston tiedosto tyyppi oli väärä ja mitkä tiedostotyypit käyvät 
                echo "Kuvasi tiedostotyyppi oli väärä lataa kuva oikeassa muodossa! Sopivia ovat jpg, jpeg ja png";
                exit();
            }



    } 
    // suljetaan yhteys
    mysqli_close($conn);
    exit;