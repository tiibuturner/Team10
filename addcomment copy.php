
<?php

$json=isset($_POST["kommentti"]) ? $_POST["kommentti"] : "";

if (!($kommentti=tarkistaJson($json))){
    print "Täytä kaikki kentät";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="insert into kommentti (name, email, message) values(?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sss', $kommentti->name, $kommentti->email, $kommentti->message);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
print $json;
?>


<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $kala=json_decode($json, false);
    if (empty($kommentti->name) || empty($kommentti->email) || empty($kommentti->message)){
        return false;
    }
    return $kommentti;
}
?>