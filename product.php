<?php
include("conect.php");
?>
<?php 

// Initialize shopping cart class 
include_once 'cartclass.php'; 
require_once 'conect.php'; 
$cart = new Cart($mysqli); 
$marime='';
include_once 'wishclass.php'; 
$wish = new Wish($mysqli); 
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Header -->   
	<?php include('header.php'); ?>
	<title><?php if ($_GET['id'] != ''){echo "Produs";}?></title>
	
</head>
<body>

<?php include('navbar.php'); ?>
<!-- navbar -->

<?php if(isset($_GET['id']) && !empty($_GET['id']))
   {?>
 	 <?php 
		  if($result = $mysqli->query("SELECT * FROM produse WHERE id='".$_GET['id']."'"))
  			 {
						if($result->num_rows>0)
			   			{
						$row = $result->fetch_object(); ?>
                       
                    

<!-- Page -->
<?php 
		  $result = $mysqli->query("SELECT * FROM produse WHERE id='".$_GET['id']."' AND categorie='femei'");
		  
						if($result->num_rows>0){
?>
 	<ul class='breadcrumb'>
 	<li><a href='index.php'>Acasa</a></li>
    <li><a href='products.php'>Produse</a></li>
 	
								
									<li><a><?php echo $row->nume; ?></a></li>;
									</ul>

		


<hr>
	<div class="product-page">
    <div class="rowprod">
        <div class="column images">
			
							<div  class="thumbs"><?php echo "<img  class='demo' src='data:image/jpeg;base64,".base64_encode($row->poza)."' onclick='currentSlide(1)'>"; ?> </div>
							<div  class="thumbs"><?php echo "<img  class='demo' src='data:image/jpeg;base64,".base64_encode($row->poza2)."' onclick='currentSlide(2)'>"; ?></div>
							<div  class="thumbs"><?php echo "<img  class='demo' src='data:image/jpeg;base64,".base64_encode($row->poza3)."' onclick='currentSlide(3)'>"; ?></div>

        </div>
        <div class="column mainimage">

					<div class="mySlides">
						<?php echo"<img src='data:image/jpeg;base64,".base64_encode($row->poza)."'>"; ?>
					</div>
					<div class="mySlides">
						<?php echo"<img src='data:image/jpeg;base64,".base64_encode($row->poza2)."' style='width:100%' >";?>
					</div>

					<div class="mySlides">
					<?php echo"<img src='data:image/jpeg;base64,".base64_encode($row->poza3)."' style='width:100%' >";?>
					</div>


					<a class="prev" onclick="plusSlides(-1)">❮</a>
  					<a class="next" onclick="plusSlides(1)">❯</a>
					
        </div>

		<?php } else{ 
			$result = $mysqli->query("SELECT * FROM produse WHERE id='".$_GET['id']."' AND categorie='fetite'" );
		  
						if($result->num_rows>0){
							$row = $result->fetch_object(); 
?>	
	<ul class="breadcrumb" >
  <li><a href="princess.php">Fetite</a></li>
								
									<li><a><?php echo $row->nume; ?></a></li>;
									</ul>
				
<hr>
	<div class="product-page">
    <div class="rowprod princess" >
   
        <div class="column mainimage" >

					<div class="mySlides">
						<?php echo"<img src='data:image/jpeg;base64,".base64_encode($row->poza)."'>"; ?>
					</div>
					
					
        </div>
		<?php }?>
		<?php }?>
		
        <div class="column details">
        <div class="product-content">
						<h2><?php echo $row->nume; ?></h2>
			
						<div class="pc-meta">
							<h4 class="price"><?php echo $row->pret; ?> RON</h4>
							<!--<i class='far fa-heart' style="font-size:16px; color:black;float:right;cursor:pointer"></i>-->
							<form id='addToWishForm' method='POST' onsubmit='addToWish(event)' style='border:none;font-size:12px; color:black;float:right;cursor:pointer'>
                                       <input type='hidden' name='id' value='<?php echo $row->id ?>'>
                                      
                                        <input type='submit' id='heartsubmit' class='fa-heart' value='&#xf004' style='border:none'>
                                       
						</form>
						</div>
							<p class="desc"><?php echo $row->descriere; ?></p>
							<ul style="padding-left:15px">
								<li class="desc"><?php echo $row->descmaterial; ?></li>
								<li class="desc"><?php echo $row->descintretinere; ?></li>
							</ul>
							<p class="desc"><?php echo $row->masurimodel;?></p>
							<p class="desc">Cod produs: <?php echo $row->id; ?></p>
							<br><hr>
							<div id="productQuanBox" class="box" style="margin-top:40px;">
								<div class="quantity">
									<label style="padding-right:10px;font-size:12px">Cantitate</label>
										<input type="number" value="1" min="1" max="5">
										<?php 
										$result = $mysqli->query("SELECT * FROM produse WHERE id='".$_GET['id']."' AND categorie='femei'");
											
											if($result->num_rows>0){
											?>
									<span onclick="openWin()"  style="float:right;cursor:pointer">Tabel marimi <i onclick="openWin()" class="fa fa-bar-chart"></i></span>
									
								<!---------------------------TABEL MARIME------------------------>
								
								<div  id="welcome">
										<div id="text">
										
											<h2 style="text-align:center;padding:30px">TABEL MARIMI</h2><br>
											<p>Pentru a putea identifica marimea potrivita in functie de dimensiunile tale consulta tabelul de mai jos.</p>
											<p class="close" style="text-align:right;color:black"><a onclick="closeWin()">X</a></p>
											<div style="overflow-x:auto;">
												<table>
													<tr>
													<th  style="padding:20px 2px;"></th>
													<th>XS/S</th>
													<th >S</th>
													<th>S/M</th>
													<th>M</th>
													<th>L</th>
													<th>L/XL</th>
													<th>XL</th>
													<th>XXL</th>
													<th>XXXL</th>
			
													</tr>
													<tr>
													<th style="padding:20px 2px">BUST</th>
													<td >84</td>
													<td>86</td>
													<td>90</td>
													<td>94</td>
													<td>98</td>
													<td>102</td>
													<td>106</td>
													<td>112</td>
													<td>118</td>
													
													</tr>
													<tr>
													<th style="padding:20px 2px">TALIE</th>
													<td >62</td>
													<td>64</td>
													<td>68</td>
													<td>72</td>
													<td>76</td>
													<td>80</td>
													<td>84</td>
													<td>90</td>
													<td>96</td>

													</tr>
													<tr>
													<th style="padding:20px 2px">SOLD</th>
													<td>90</td>
													<td>92</td>
													<td>96</td>
													<td>100</td>
													<td>104</td>
													<td>108</td>
													<td>112</td>
													<td>118</td>
													<td>124</td>
					
													</tr>
												</table>
											</div>
										
										</div>
									</div>
								
									<!---------------------------TABEL MARIME------------------------>
									<?php } else {?>
										<span onclick="openWin()"  style="float:right;cursor:pointer">Tabel marimi <i onclick="openWin()" class="fa fa-bar-chart"></i></span>
									
								<!---------------------------TABEL MARIME------------------------>
								
								<div  id="welcome">
										<div id="text">
										
											<h2 style="text-align:center;padding:30px;">TABEL MARIMI</h2><br>
											<p>Pentru a putea identifica marimea potrivita in functie de dimensiuni, consulta tabelul de mai jos.</p>
											<p class="close" style="text-align:right;color:black"><a onclick="closeWin()">X</a></p>
											<div style="overflow:auto;">
												<table>
													<tr>
													<th style="padding:10px">Marime</th>
													<th >Varsta</th>
													<th>Inaltime</th>
                                                    </tr>
                                                    
													<tr>
													<td style="padding:5px">100</td>
													<td>3-4</td>
													<td>93-102cm</td>
                                                    </tr>
                                                    
													<tr>
													<td style="padding:5px">110</td>
													<td>4-5</td>
													<td>103-112cm</td>
                                                    </tr>

                                                    <tr>
                                                    <td style="padding:5px">120</td>
                                                    <td>6-7</td>
                                                    <td>113-122cm</td>
                                                    </tr>

                                                    <tr>
                                                    <td style="padding:5px">130</td>
                                                    <td>8-9</td>
                                                    <td>123-132cm</td>
                                                    </tr>

                                                    <tr>
                                                    <td style="padding:5px">140</td>
                                                    <td>10-11</td>
                                                    <td>133-142cm</td>
                                                    </tr>

                                                    <tr>
                                                    <td style="padding:5px">150</td>
                                                    <td>11-12</td>
                                                    <td>143-152cm</td>
                                                    </tr>

                                                    <tr>
                                                    <td style="padding:5px">160</td>
                                                    <td>13-14</td>
                                                    <td>153-162cm</td>
                                                    </tr>

                                                    <tr>
                                                    <td style="padding:5px">170</td>
                                                    <td> >14</td>
                                                    <td> >162cm</td>
                                                    </tr>


												
												</table>
											</div>
										
										</div>
									</div>
									<!---------------------------TABEL MARIME------------------------>
									<?php } ?>
						</div>
						</div>
							<div id="sizeSetter" class="custom-selectt"> <i class="fa fa-caret-down" style="padding-top:7px"></i>
								<select id="marimeid" >   
									<option value="0">Selecteaza marime:</option>
									<?php
										$sizes = explode(", ", $row->marimi);
										foreach($sizes as $size)
										{
									?>
									<option value="<?php echo $size; ?>"><?php echo $size; ?></option>
									<?php } ?>
								</select>
							</div>
							<p style="margin-left:3%; margin-bottom:20px;margin-top:20px;color:rgba(51, 50, 50, 0.7)"> Rochia se afla momentan in stoc doar pe culoare si marimea afisata. Poti insa sa o comanzi pe marimea dorita. Pentru mai multe informatii contacteaza-ne pe chat.</p>
							
							
							<!-----masura femei--->
							<?php 
										$result = $mysqli->query("SELECT * FROM produse WHERE id='".$_GET['id']."' AND categorie='femei'");
											
											if($result->num_rows>0){
											?>
							<button type="button" style="border:none" class="measure" onclick="openm()">Comanda pe masura ta</button>

									 <!---------------------------PE MASURA------------------------>
									 
									
										
										
									<div id="myMeasure" class="moverlay">
											<div class="moverlay-content">
											 <a href="javascript:void(0)" class="closebtn" style="top:1px;right:2px;color:black" onclick="closem()">&times;</a>
												<h2 style="color:rgb(107, 89, 53)"><b>COMANDA ROCHIA PE MASURA TA</b></h2><br>
												<p style="padding:20px 60px; font-size:12px">Pentru a crea rochia dorită pe măsurile tale, echipa noastră crează tipare personalizate pentru fiecare comandă. Completează spațiile de mai jos cu dimensiunile corecte și complete înainte să faci comanda. Pentru a reuși să te măsori cât mai corect posibil verifică mai jos ghidul nostru de măsurători, iar dacă ai întrebări nu ezită să ne ceri sfatul.</p>
																<form>
																<div class="rowmeasure">
																	<div class="r1" >
																
																		<label for="luf">LATIME UMERI FATA</label><br>
																		<input type="text" class="ad" name="luf" >
																		<span class="error"> </span><br><br>
																		<label for="dsani">DEASUPRA SANILOR</label><br>
																		<input type="text"  class="ad" name="dsani"  >
																		<span class="error"> </span><br><br>
																		<label for="dapex">DISTANTA APEX</label><br>
																		<input type="text" class="ad" name="dapex"  >
																		<span class="error"></span><br><br>
																		<label for="dtabdomen">DISTANTA TALIE-ABDOMEN</label><br>
																		<input type="text"  class="ad" name="dabdomen" >
																		<span class="error"> </span><br><br>
																		<label for="dtsold">DISTANTA TALIE-SOLD</label><br>
																		<input type="text" class="ad"  name="dtsaold" >
																		<span class="error"> </span><br><br>
																		<label for="dutalie">DISTANTA UMERI-TALIE</label><br>
																		<input type="text"  class="ad" name="dutalie" >
																		<span class="error"> </span><br>
																		<label for="abdomen">ABDOMEN</label><br>
																		<input type="text" class="ad" name="abdomen" >
																		<span class="error"> </span><br><br>
																		<label for="sol">SOLD</label><br>
																		<input type="text"  class="ad" name="sold"  >
																		<span class="error"> </span><br><br>
																		<label for="lrochie">LUNGIME ROCHIE</label><br>
																		<input type="text"  class="ad" name="lrochie"  >
																		<span class="error"> </span><br><br>
																	
																	</div>
																	<div class="r1" >

																			<label for="dub">DISTANTA UMAR-BUST</label><br>
																			<input type="text" class="ad" name="dub" >
																			<span class="error"> </span><br><br>
																			<label for="biceps">CIRCUMFERINTA BICEPS</label><br>
																			<input type="text"  class="ad" name="biceps"  >
																			<span class="error"> </span><br><br>
																			<label for="cot">CIRCUMFERINTA COT</label><br>
																			<input type="text"  class="ad" name="cot"  >
																			<span class="error"> </span><br><br>
																			<label for="incheietura">CIRCUMFERINTA INCHEIETURA</label><br>
																			<input type="text"  class="ad" name="incheietura"  >
																			<span class="error"> </span><br><br>
																			<label for="bust">BUST</label><br>
																			<input type="text" class="ad" name="bust"  >
																			<span class="error"></span><br><br>
																			<label for="talie">TALIE</label><br>
																			<input type="text" class="ad"  name="talie" >
																			<span class="error"> </span><br>
																			<label for="luspate">LATIME UMERI SPATE</label><br>
																			<input type="text" class="ad" name="luspate"  >
																			<span class="error"> </span><br><br>
																			<label for="lspate">LATIME SPATE</label><br>
																			<input type="text" class="ad" name="lspate"  >
																			<span class="error"></span><br><br>
																			<label for="dutspate">DISTANTA UMAR TALIE SPATE</label><br>
																			<input type="text" class="ad"  name="dutspate" >
																			<span class="error"> </span><br>

																	</div>
																	

																</div>
															<div class="containersubmit">
																<input type="submit" name="submit" value="ADAUGA IN COS">
															</div>

														</form>
														
													<div class="rowmeasure">
														<div class="r1" style="width:25%">
															<img src="poze/m1.jpg" alt="Snow" style="width:100%">
  														</div>
														<div class="r1"  style="width:25%">
															<img src="poze/m2.jpg" alt="Snow" style="width:100%">
														</div>
														<div class="r1"  style="width:25%">
															<img src="poze/m3.jpg" alt="Snow" style="width:100%">
														</div>
														<div class="r1"  style="width:25%">
															<img src="poze/m4.jpg" alt="Snow" style="width:100%">
														</div>
													</div>
											</div>

											<?php } ?>
									</div>	


							<form id="addToCartForm"  method="POST" >
								<input type="hidden" name="id" value="<?php echo $row->id; ?>">	
								<input type="hidden" name="cantitate" value="1">
								<input type="hidden" name="marime">
												
							
							<?php if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){?>
								<input type='submit' class='measure adauga' disabled value='ADAUGA IN COS'>
								<br>
								<p style="color:red; text-align:center"> Va rugam sa va autentificati pentru a putea adauga produs in cos! </p>
							<?php } else {?>
							
							
								<input type="submit" class="measure adauga" value="ADAUGA IN COS">
							<?php } ?>
							</form>
						</div>
						
					</div>
				</div>
			</div>
        </div>
		</div>
		
		<?php }  ?>
	<?php }  ?>
</div>  
		

<hr>
		<div class="rowcc" >
          <div class="columnc r product" style="text-align:justify;padding:100px">
            <h2 >Politica de retur</h1>
            <p>"Consumatorul are dreptul să notifice în scris comerciantului că renunţă la cumpărare, fără penalităţi şi fără invocarea unui motiv, în termen de 10 zile lucrătoare de la primirea produsului. - Art. 4, B Cap. I, ORDONANTA nr.130 din 31 august 2000 privind regimul juridic al contractelor la distanţă. Clienţii pot returna produsele cumpărate, în ambalajul original, în termen de 10 zile lucrătoare de la primire, fără penalităţi şi fără invocarea vreunui motiv. Returnarea produselor se va face pe cheltuiala clientului.</p>
          </div>
      
          <div class="columnc l product"  style="text-align:justify;padding:100px">
							<h2>Transport</h1>
            <p> TTransportul pe teritoriul Romaniei se efectueaza cu curierii locali si costa 25 lei pentru comenzile sub 200 lei. Toate comenzile peste 200 lei beneficiaza de TRANSPORT GRATUT. Pentru comenzile in afara Romaniei utilizam transportul cu : 1. TNT - coletul ajunge in 3-5 zile si costul este de 80 euro 2. POSTA ROMANA - coletul ajunge in 15 zile si costul este de 40 euro Toate comenzile in afara Romaniei care depasesc 800 euro au TRANSPORT GRATUIT.</p>
          
			</div>
		
		</div>
		<!-- RECOMANDARi---->
	

		<?php
			
		$colectie=$row->colectie;
		$result = $mysqli->query("SELECT * FROM produse WHERE categorie='femei' AND colectie='$colectie'  ORDER BY RANd() LIMIT 4 ");

	
		if($result->num_rows > 0)
	{
		echo"<hr>";
		echo"<div class='containertop' style='background-color:white;margin-top:10px'>";
		echo"<h1 class='titlecourse' style='font-size:20px'>  RECOMANDARI </h1><br>";
		echo"</div>";
		echo"<div class='recomandariproduse'>";



        while($row=$result->fetch_object())
		{
		
			echo "<div class='responsive' style='padding-left:20px; padding-right:20px'>";
			echo "<div data-aos='fade-up' class='gallery'>";
			echo"<a href='product.php?id=".$row->id."'>";
			echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  width="600px" height="400">';
                        echo"<div class='middle'> <div class='text'>";
                               echo" <form id='addToWishForm' method='POST' style='border:none;'>";
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
	<?php }?>
</div>

	</div> 
	


		

	<!--====== Javascripts & Jquery ======-->
	



</script>	

<script>
function openWin() {
	document.getElementById("welcome").style.display = "block";
}

function closeWin() {
	document.getElementById("welcome").style.display = "none";
}
</script>

<script>
function openm() {
  document.getElementById("myMeasure").style.height = "100%";
}

function closem() {
  document.getElementById("myMeasure").style.height = "0%";
}
</script>

	<script src="jss/jquery-3.2.1.min.js"></script>

	<script src="js/selectcustom.js"></script>
	<script src="js/productimageswitch.js"></script>
	<script src="js/search.js"></script>
	<?php include('footer.php'); ?>
	<script src="js/product.js"></script>
	<script src="js/wishlist.js"></script>
	
	</body>
</html>


