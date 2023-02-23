<?php

$json=isset($_POST["kommentti"]) ? $_POST["kommentti"] : "";
if (!($kommentti=tarkistaJson($json))){
    print "Täytä kaikki kentät";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
$initials=parse_ini_file("../Team10/.ht.asetukset.ini");
try {
    $yhteys=mysqli_connect($initials["databaseserver"], $initials["username"], $initials["password"], $initials["database"]);
} catch (Exception $e) {
    header("location:../html/yhteysvirhe.html");
    exit;
}
$sql="insert into guestbook (name, email, message, kaynyt) values(?, ?, ?, ?)";
try{
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'sssi', $kommentti->name, $kommentti->email, $kommentti->message, $kommentti->kaynyt);
    mysqli_stmt_execute($stmt);

}catch(Exception $e){
    print "Virhe! Tarkista kaikki kohdat.";
}
    print $json;
    mysqli_close($yhteys);
?>
<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $kommentti=json_decode($json, false);
    if (empty($kommentti->name) || empty($kommentti->email || empty($kommentti->message))){
        return false;
    }
    return $kommentti;
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vieraskirja</title>
    <style>
    </style>
    </head>
    <body>
</body>
</html> 