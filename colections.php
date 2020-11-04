<!DOCTYPE html>
<html lang="ro">
<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<!-- navbar -->
<body>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="containertop">
  <h2 style="font-family:Linden Hill;">COLECTII</h2>
  <hr class="curs">
  </div>

  <?php
	include("conect.php");
		$result = $mysqli->query("SELECT * FROM colectii");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		
      echo"<a href='products.php?id=".$row->denumire."'><div class='photo' data-aos='fade-up' data-aos-delay='150' style='background-image:url(data:image/jpeg;base64," . base64_encode($row->coperta) . ")'><div class='blurc'><h1 style='padding-top:15px' class='collectionname'><i>".$row->denumire."</i></h1></div></div></a>";

      
			
		}
	}
	echo"<div class='clearfix'></div>";
	
	$mysqli->close();
	?>


</div>

<!-------------------------------------------- SCRIPTS----------------------------->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/zoom.js"></script>
<script>
  AOS.init();
</script>
<script src="js/search.js"></script>
</body>
<?php include('footer.php'); ?>
</html>

