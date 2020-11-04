<!DOCTYPE html>
<html lang="ro">
<head>

<?php include('header.php'); 

?>
</head>
<body>

<!-- include navbarul peste tot -->
<?php include('navbar.php'); ?>
<!-- navbar -->

<div class="colectii">
<div class="indexresponsive" >
			  <div class="gallery" id="hidethis1">
			
				  <img class="image" src="poze/colectii/p15.jpg" >
				  </div>
			
			  </div>
            </div>
            <div class="indexresponsive" id="hidethis2" style="widht:auto ">
			  <div class="gallery">
		
				  <img class="image" src="poze/colectii/p19.jpg" >
				  </div>
				
			  </div>
            <!-- </div> -->
            <div class="indexresponsive">
			  <div class="gallery">
				
				  <img class="image" src="poze/colectii/p18.jpg" >
				  </div>
				
			  </div>
    

<div class='clearfix'></div>
</div>

	<section>
	<div class="newcollection">
	<?php
	include("conect.php");
		$result = $mysqli->query("SELECT * FROM colectii ORDER BY creat DESC LIMIT 1");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		echo'<a style="text-decoration:none; color:black" href="products.php?id='.$row->denumire.'" ><p  id="viewnewcollection">Descopera noua colectie  &#10146</p></a>';
				
	}
}


?>
	</div>


    <div class="col-md-12 text-center">
          	<h1 class="big">Produse</h1>
            <h3 class="mb-4">Produse</h3>
    </div>
	<!--<h1 class="col"><b>PRODUSE</b></h1>-->
	<div class="collection">
	<?php

		$result = $mysqli->query("SELECT * FROM produse WHERE categorie='femei' AND colectie='Endless Summer' ORDER BY RANd() LIMIT 4 ");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		
			echo "<div class='responsive'>";
			echo "<div data-aos='fade-up' class='gallery'>";
			echo"<a href='product.php?id=".$row->id."'>";
			echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  width="600px" height="400">';
			echo"<div class='middle'> <div class='text'>";
			echo" <form id='addToWishForm' onsubmit='addToWish(event)'  method='POST' style='border:none;'>";
			echo" <input type='hidden' name='id' value='".$row->id."'>	";
		   
			 echo"<input type='submit' id='heartsubmit' class='fa-heart' ' value='&#xf004' style='border:none;padding:1px;'>";
			
	 echo"</form>";


			echo "</div>";
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
	<div data-aos="fade-up"  class="wrapper"><button onclick="window.location.href='products.php'" type="button" class="button">VEZI TOATE PRODUSELE</button></div>
	</div>

	
	<div class="photo"><div style="height:90px; padding-top:20px" class="blurc"><h1 class="collectionname"><i>Spring illusion</i></h1><a href="products.php?id=Spring Illusion"><p>Descopera colectia</p></a></div></div>

	<div class="meetxenia" data-aos="fade-up">
		
	<div class="col-md-12 text-center" style="margin-top:0px; margin-bottom:30px">
          	<h1 class="big">Despre noi</h1>
            <h3 class="mb-4">Despre noi</h3>
    </div>
      		<p class="prezentare" data-aos="fade-up"  class="mb-4" id="prezentare">Xenia este un atelier de creație vestimentară dedicat exclusiv publicului feminin de orice vârstă. Originalitatea și aptitudinile designerului Diana Xenia Tanca se împletesc armonios cu cele ale echipei sale în realizarea chiar și a celor mai elaborate rochii de gală, a celor de mireasă, ținute casual și nu numai.</p>
			<div id="more">În showroom-ul Xeniei, fiecare clientă are parte de o experiență unică. Orice comandă aduce după sine stabilirea modelului de către designer împreună cu clienta, după doleanțele și plăcerile acesteia. În ceea ce privește ținutele aflate în stoc, clientele pot alege și proba diverse modele de rochii pentru cununia civilă, nunți, botezuri, putând achiziționa și rochițe pentru bebelușe. Accesoriile rochiilor sunt create în întregime de către echipa Xeniei.</div>
			<div class="wrapper" data-aos="fade-up"><button type="button" id="btnmore" class="buttonmore">AFLA MAI MULTE</button></div>
			<script src="js/slide_more.js"></script>
	</div>

	<div class="owl-carousel owl-theme" style="margin-bottom:30px;">
		<div class="item">
			<img src="poze/prezentare/2.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/4.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/5.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/6.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/8.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/9.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/10.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/14.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/16.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/17.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/18.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/20.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/21.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/22.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/24.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/25.jpg" class="img-fluid" alt="12">
		</div>
		<div class="item">
			<img src="poze/prezentare/26.jpg" class="img-fluid" alt="12">
		</div>
	</div>



<!--------------------------------SCRIPTS_--------------------------------------------->
<script src="js/search.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<link href="owl/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="owl/owl.theme.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="owl/owl2.css">
<script src="jquery/jquery.js" type="text/javascript"></script>
<script src="owl/owl.carousel.js" type="text/javascript"></script>
<script src="js/wishlist.js"></script>
<script type="text/javascript">

	$('.owl-carousel').owlCarousel({
		loop:true,
		margin:5,
		nav:true,
		autoplay:true,
		autoplayTimeout:1500,
		responsive:{
			0:{
				items:2
			},
			600:{
				items:4
			},
			1000:{
				items:6
			}
		}
	})

</script>
</body>
<?php include('footer.php'); ?>
</html>