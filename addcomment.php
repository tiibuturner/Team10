<?php
// $name = isset ($_POST["name"]) ? $_POST["name"] : "";
// $email = isset ($_POST["email"]) ? $_POST["email"] : "";
// $nimi = isset ($_POST["checkbox"]) ? $_POST["checkbox"] : [];
// $message = isset ($_POST["message"]) ? $_POST["message"] : "";
$json=isset($_POST["kommentti"]) ? $_POST["kommentti"] : "";
if (!($kommentti=tarkistaJson($json))){
    print "Täytä kaikki kentät";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try {
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
} catch (Exception $e) {
    header("location:../html/yhteysvirhe.html");
    exit;
}
$sql="insert into guestbook (name, email, message) values(?, ?, ?)";//sama kuin SHA2(?, 0)
try{
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $kommentti->name, $kommentti->email, $kommentti->message);
    mysqli_stmt_execute($stmt);
$sql="insert into checkbox (kaynyt) values(?)";
try{
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'b', $kommentti->kaynyt);
    mysqli_stmt_execute($stmt);

}
    mysqli_close($yhteys);
    print $json;
}
catch(Exception $e){
    print "Tunnus jo olemassa tai muu virhe!";
}
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
<?php
// if (!empty($name) && !empty($email)) {
//     $sql="insert into guestbook (name, email) values(?, ?)";
//     //Valmistellaan sql-lause.
//     $stmt=mysqli_prepare($yhteys, $sql);
//     //Sijoitetaan muuttujat oikeisiin paikkoihin.
//     mysqli_stmt_bind_param($stmt, 'ss', $name, $email);
//     //Suoritetaan sql- lause.
//     mysqli_stmt_execute($stmt);
/*
foreach($_POST['checkbox'] as $rivi->nimi)
    {
        echo 'Checked: '.$rivi->nimi ;
    }
*/
// foreach ($nimi as $puistokaynti) {
//     $sql="insert into puistokaynti(gid, cid) values(?, ?)";
// 	$stmt=mysqli_prepare($yhteys, $sql);
// 	mysqli_stmt_bind_param($stmt, 'ii', $last_id, $puistokaynti);
// 	mysqli_stmt_execute($stmt);
//  }
// if (!empty($message)) {
// 	$sql="insert into guestbook (message) values(?)";
// 	$stmt=mysqli_prepare($yhteys, $sql);
// 	mysqli_stmt_bind_param($stmt, 's', $message);
// 	mysqli_stmt_execute($stmt);
//  }
//    header("Location:addcomment.php");
//    exit;
// }
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
<?php
print "<table border='1'>";
$tulos=mysqli_query($yhteys, "select * from guestbook, checkbox, puistokaynti where guestbook.id=puistokaynti.gid and puistokaynti.cid=checkbox.id");
while ($rivi=mysqli_fetch_object($tulos)) {
    print "<tr>
    <td>$rivi->name
    <td>$rivi->email
    <td>$rivi->nimi
    <td>$rivi->message
    <td>$rivi->cid
    </td>
    </tr>";
}
print "</table>";
//Suljetaan tietokantayhteys.
mysqli_close($yhteys);
/* Kommentissa OG koodi.
<?php
$host="db"; //Add your SQL Server host here
$user="root"; //SQL Username
$pass="password"; //SQL Password
$dbname="vieraskirja"; //SQL Database Name
$con=mysqli_connect($host,$user,$pass,$dbname);
if (mysqli_connect_errno($con))
{
echo "<h1>Failed to connect to MySQL: " . mysqli_connect_error() ."</h1>";
}
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
$checkbox = isset ($_POST["checkbox"]) ? $_POST["checkbox"] : [];
$sql="INSERT INTO guestbook(name,email,message) VALUES('$name','$email','$message')";
if (!mysqli_query($con,$sql))
{
die('Error: ' . mysqli_error($con));
}
else{
echo "Values Stored in our Database!";
mysqli_close($con);
}
?>*/
?>
</body>
</html> 