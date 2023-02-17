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
    <header class="image row"><a href="index.html"></a>
    <h1 class="headerfp">Kanta-Hämeen Kansallispuistot</h1>
    </header>
        
    <div class="main">
           
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
    
        <section class="gallery-links">
        <h1 class="h1">Kansallispuiston kuvagalleria</h1><br><br>
            <div class="wrapper">
                
                <div class="gallery-container">
                
                    <?php

                    include_once './dbh.inc.php';

                    $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed!";
                    } else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        
                        while($row= mysqli_fetch_assoc($result)){
                            
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
        <section><div>
        <p>Haluatko lisätä omia kansallispuisto muistojasi kuvagalleriaamme?</p><br>
        <p>Pääset <a href="uploadlomake.php" ><input type="button" name="Täältä" value="Täältä" class="pekka" ></a> lisäämään omia kuviasi galleriaan.</p>
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
    <footer class="row">
        <div style="clear: both;">
        <p class="eka">Tiina, Marika & Linnea @ 2023</p>
        <p class="toka">Kuvat © Marika Salonen</p>
        </div>
    </footer>


    <script>
    Mene(){
         
        window.open(uploadlomake.php);
        
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
</body>
</html>