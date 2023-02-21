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

                                print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                                ' margin:60px;">Et täyttänyt kuvan otsikkoa tai lisätietoja kuvalle.</h3>';

                                print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Muista täyttää".
                                " kaikki kentät ja valita kuva, niin saat ladattua kuvan galleriaamme. <br><br>Pääset ".
                                "takaisin lomakkeelle viereisestä painikkeesta. <a style='color: rgb(38, 99, 0); background-color: ".
                                "rgba(107, 131, 77, 0.758); text-decoration: none; padding: 5px; text-align: center;".
                                " box-shadow: 5px 5px;' href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";

                                exit();

                            // Muuten voidaan jatkaa eteenpäin 
                            }else{

                                // valitaan kaikki gallery taulusta
                                $sql = "SELECT * FROM gallery;";
                                $stmt = mysqli_stmt_init($conn);

                                    // jos prepare statement epäonnistuu niin se kerrotaan
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        
                                        print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                                            ' margin:60px;">Yhteys virhe kuvaa ei saatu ladattua galleriaan.</h3>';

                                        print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Yritä myöhemmin uudestaan.".
                                        "Pääset takaisin lomakkeelle viereisestä painikkeesta. <a style='color: rgb(38, 99, 0); background-color: ".
                                            "rgba(107, 131, 77, 0.758); text-decoration: none; padding: 5px; text-align: center;".
                                            " box-shadow: 5px 5px;' href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";
                                    
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
                                            
                                                print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                                                ' margin:60px;">Yhteyttä ei onnistuttu muodostamaan palvelimeen ja kuvaa ei saatu ladattua galleriaan.</h3>';

                                                print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Yritä myöhemmin uudestaan.".
                                                    "<br><br>Pääset takaisin lomakkeelle viereisestä painikkeesta. <a style='color: rgb(38, 99, 0); background-color: ".
                                                    "rgba(107, 131, 77, 0.758); text-decoration: none; padding: 5px; text-align: center;".
                                                    " box-shadow: 5px 5px;' href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";
                                                
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
                        print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                                ' margin:60px;">Kuva tiedosto on liian suuri ladattavaksi.</h3>';

                        print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Valitse kuva,".
                              " jonka koko ei ole liian suuri ja muista täyttää kaikki tiedot ennen kuin lähetät kuvan. <br><br>Pääset ".
                              "takaisin lomakkeelle viereisestä painikkeesta. <a style='color: rgb(38, 99, 0); background-color: ".
                              "rgba(107, 131, 77, 0.758); text-decoration: none; padding: 5px; text-align: center;".
                              " box-shadow: 5px 5px;' href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";
                        exit();
                    }

                } else {
                
                    // kerrotaan että kuvan lataamisessa tapahtui jokin virhe
                    print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                    ' margin:60px;">Kuvatiedostossa on joku virhe, joten kuvaa ei saatu ladattua galleriaan.</h3>';

                        print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Yritä uudestaan. Valitse kuva".
                              " ja muista täyttää kaikki tiedot ennen kuin lähetät kuvan. <br><br>Pääset ".
                              "takaisin lomakkeelle viereisestä painikkeesta. <a style='color: rgb(38, 99, 0); background-color: ".
                              "rgba(107, 131, 77, 0.758); text-decoration: none; padding: 5px; text-align: center;".
                              " box-shadow: 5px 5px;' href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";
                    exit();
                }
        
            } else {
                
                //Kerrotaan että lataus epäonnistui ja, että kuvatiedoston tiedosto tyyppi oli väärä ja mitkä tiedostotyypit käyvät 
                print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                    ' margin:60px;">Laittamasi kuvasi tiedostotyyppi on väärässä muodossa!</h3>';

                        print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Sopivia ovat,".
                              " jpg, jpeg ja png muodossa olevat kuvat. Muista myös täyttää kaikki tiedot ennen". 
                              "kuin lähetät kuvan. <br><br>Pääset takaisin lomakkeelle viereisestä painikkeesta.". 
                              "<a style='color: rgb(38, 99, 0); background-color: rgba(107, 131, 77, 0.758); ".
                              "text-decoration: none; padding: 5px; text-align: center; box-shadow: 5px 5px;'".
                              " href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";
                exit();
            }



    } else {
        // Ilmoitetaan virheestä jos lomakkeelta ei saatu dataa
        print '<h3 style="font-family: Arial, Helvetica, sans-serif; color:rgb(103, 163, 109);'.
                    ' margin:60px;">Tapahtui jokin virhe ja kuvaa ei saatu ladattua galleriaan.</h3>';

                        print "<p style='font-family: Arial, Helvetica, sans-serif; margin:60px;'>Yritä uudestaan".
                              " ladata kuva ja muista täyttää kaikki kuvan tiedot ennen kuin lähetät kuvan. <br><br>Pääset ".
                              "takaisin lomakkeelle viereisestä painikkeesta. <a style='color: rgb(38, 99, 0); background-color: ".
                              "rgba(107, 131, 77, 0.758); text-decoration: none; padding: 5px; text-align: center;".
                              " box-shadow: 5px 5px;' href='./uploadlomake.php'>Takaisin lomakkeelle.</a></p>";
        exit();
    }
    // suljetaan yhteys
    mysqli_close($conn);
    exit;