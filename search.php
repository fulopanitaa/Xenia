<?php
session_start();
include("conect.php");


$cuvant=$_GET['cuvant'];
?>


<!DOCTYPE html>
<html lang="ro">
<head>
</head>
<body>
<?php include('header.php'); ?>
<!-- include navbarul peste tot -->
<?php include('navbar.php'); ?>
<!-- navbar -->


<div class="containertop">
    <h2 style="font-family:Linden Hill;">REZULTATUL CAUTARII</h2>
  </div>

<div>
<p> Textul cautat: <b><?=$cuvant?> </b></p>
<blockquote>
<?php 
$sql="SELECT * FROM produse WHERE nume LIKE '%".$cuvant."%'";
$result=$mysqli->query($sql);

if($result->num_rows > 0){
while($row=$result->fetch_object()){
  echo "<div class='responsive'>";
  echo "<div data-aos='fade-up' class='gallery'>";
  echo"<a href='product.php?id=".$row->id."'>";
  echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  width="600px" height="400">';
                    echo"<div class='middle'> <div class='text'>";
                           echo" <form id='addToWishForm' onsubmit='addToWish(event)' method='POST' style='border:none;'>";
                                   echo" <input type='hidden' name='id' value='".$row->id."'>	";
                                  
                                    echo"<input type='submit' id='heartsubmit' class='fa-heart' ' value='&#xf004' style='border:none;padding:1px;'>";
                                   
                            echo"</form>";
                    echo"</div>";
  echo "</div>";
  echo"</a>";	
  echo"</div>";
  echo"<p class='pname'>".$row->nume."</p>";
  echo"<p class='pprice'>".$row->pret." RON</p>";
                    echo"</div>";  
}
echo"<div class='clearfix'></div>";

}


?>


</div>


<script src="js/search.js"></script>
<script src="js/wishlist.js"></script>
</body>
<?php include('footer.php'); ?>
</html>