<?php
$initials=parse_ini_file("../.ht.asetukset.ini");
// tehdään stmt tarvittavista tiedoista oma muuttujansa helpottaakseen asioita


$conn = mysqli_connect($initials["databaseserver"], $initials["username"], $initials["password"], $initials["database"]);



?>