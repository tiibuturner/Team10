<?php
session_start();
$initials=parse_ini_file("../Team10/.ht.asetukset.ini");

if(isset($_POST["tunnus"]) && isset($_POST["salasana"])){
    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"];
}
else{
    header("Location:rekisteroityminen.html");
    exit;
}

$yhteys=mysqli_connect($initials["databaseserver"], $initials["username"], $initials["password"], $initials["database"]);


$sql="select * from poj_users where tunnus=? and salasana=SHA2(?, 256)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ss", $tunnus, $salasana);
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);


if ($rivi=mysqli_fetch_object($tulos)){
    $_SESSION["user_ok"]="ok";
    header("Location:../Team10/kuvagalleria/uploadlomake.php");

    exit;
}
else{
    header("Location:kirjaudu.php");
    exit;
}
?>