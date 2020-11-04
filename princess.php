<!DOCTYPE html>
<html lang="ro">
	<head>
<?php include('header.php'); 
?>

<!--Style-->

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>

#nav{
  height:70px;
  padding-top:25px;
}
#logo{
	position:absolute;
	top:0px;
	height:55px;
	transition:0.4s;
	transition-timing-function: ;
}
.logo{
	left:51%;
}
body{
	padding-top:100px;
}

</style>


</head>
<body>

<?php include('navbar.php'); ?>
<!-- navbar -->

<div class="wrapperv" onclick="playPause()">

   <video id="princess" muted autoplay="autoplay" loop class="wrapper__video">
      <source src="poze/fetite.MOV">
   </video>
   <div class="overlayvideo">
        <p id="title">Little Princess By Xenia</p>
        <p>Creatii unicate pentru fetita ta</p>
        <a href="#jump"> Vezi produsele</a>
    </div>
  
</div>
<div class="containertop" style="margin-top:0px;">
	<h2 style="font-family:Linden Hill;">LITTLE PRINCESS BY XENIA</h2>
	<hr class="curs" id="jump">
	<br>
  </div>


<div class="produse"  Style="margin-top:50px;">
<?php
	include("conect.php");
		$result = $mysqli->query("SELECT * FROM produse WHERE categorie='fetite' ");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		
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
	}
	echo"<div class='clearfix'></div>";
	
	$mysqli->close();
	?>
</div>


<!--Javascript-->
<script src="js/reversenavshrink.js"></script>
		<!--Scroll toggle-->
<script>
$(window).scroll(function(){
	$('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
}); 
</script>
<script src="js/playpausevideo.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="js/search.js"></script>
<script src="js/wishlist.js"></script>
</body>
<?php include('footer.php'); ?>
</html>
