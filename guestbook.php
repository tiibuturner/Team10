<?php
// Näyttää "tulokset"
$host="db"; //Add your SQL Server host here localhost
$user="root"; //SQL Username
$pass="password"; //SQL Password
$dbname="vieraskirja"; //SQL Database Name  slashcoding
$con=mysqli_connect($host,$user,$pass,$dbname);
if (mysqli_connect_errno($con))
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT name,message,nimi FROM vieraskirja");
while($row = mysqli_fetch_array($result))
{ ?>
<h3><?php echo $row['name']; ?></h3>
<p><?php echo $row['message']; ?></p>
<p><?php echo $row['nimi']; ?></p>
<?php }
mysqli_close($con);
?>