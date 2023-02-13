<?php 
// Include the database configuration file  
require_once 'dbConfig.php'; 
 
// Get image data from database 
$result = $db->query("SELECT image FROM images ORDER BY id DESC"); 
?>

<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
    <div class="row">
    
        <?php 
        while($row = $result->fetch_assoc()){ ?>
           <div class="column">
            <img style="width:100%" src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']); ?>" onclick="myFunction(this);">
            </div>
        <?php } ?> 
        </div>
    </div> 
    
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>

<!-- The expanding image container -->
<div class="container">
  <!-- Close the image -->
  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

  <!-- Expanded image -->
  <img id="expandedImg" style="width:100%">

  
</div>
<script>
function myFunction(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/imagegallery.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>