<?php
if (isset($_POST["tunnus"]) && isset($_POST["salasana"]) && 
    isset($_POST["etunimi"]) && isset($_POST["sukunimi"])) {

    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"];
    $etunimi=$_POST["etunimi"];
    $sukunimi=$_POST["sukunimi"];
}

else {
    header("Location:rekisteroityminen.html");
    exit;
}

$yhteys=mysqli_connect("db", "root", "password");
$tietokanta=mysqli_select_db($yhteys,"poj_userdata");
$sql="insert into poj_users values(?, SHA2(?, 256), ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $salasana, $etunimi, $sukunimi);
mysqli_stmt_execute($stmt);


header("Location:kiitos.html");
exit;

?>