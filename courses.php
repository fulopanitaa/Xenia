<!DOCTYPE html>
<html lang="ro">
	<head>

<?php include('header.php'); 
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



<!-- Style-->

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
body{
	padding-top:100px;
}
</style>
 

</head>
<body>

<?php include('navbar.php'); ?>
<!-- navbar -->
<!-------------------------------------------- VIDEO------------------------------------>
<div class="wrapperv" onclick="playPause()">

   <video id="princess"  muted autoplay="autoplay" loop class="wrapper__video">
      <source src="poze/curs.MOV">
   </video>
   <div class="overlayvideo">
        <p id="title">Invata Design De La Xenia</p>
        <p>Cu posibilitatea de a invata de oriunde</p>
        <a href="#jumptooffer"> OFERTA DE CURSURI</a>
    </div>

</div>

 

<!-------------------------------------------- PAGINA CURSURI----------------------------->

<div class="containertop" style="padding:10px;padding-top:100px;margin-top:0px;background-color:white">
    <h1 class="titlecourse">  CURSURI ONLINE DE CREATIE VESTIMENTARA </h1><br>
    <p style="font-size:12px;padding:0;text-align:center"> Pentru cele pasionate de fashion cat si pentru cele care vor sa-si foloseasca imaginatia intr-un mediu practic, sau doresc sa-si creeze propria linie vestimentara.
</div>
<hr class="curs">
<div class="photo courses">
         <div class="one" data-aos="fade-right"  data-aos-delay="160" style="padding-top:200px;">
              <div class="titlediv "> 
                  <h3 style="text-align:center;"><b>O PASIUNE</b></h3> 
              </div>
                            
          </div>
         <div class="one" data-aos="fade-right" data-aos-delay="190">
              <div class="titlediv "> 
                  <h3 style="text-align:center;"><b>UN INCEPUT NOU DE CARIERA</b></h3> 
              </div>
          </div>

        <div class="one" data-aos="fade-right" data-aos-delay="220">
              <div class="titlediv "> 
                  <h3 style="text-align:center;"><b>UN VIS INDEPLINIT</b></h3> 
              </div>
        </div>
        <div class="one" data-aos="fade-right" data-aos-delay="250">
              <div class="titlediv "> 
                  <h3 style="text-align:center;"><b>O NECESITATE</b></h3> 
              </div>
        </div>
</div>

        <div class="rowcc" >
                <div class="columnc r" style="text-align:justify">
                
                  <p>Cursurile de Fashion în Cluj: Curs Design Vestimentar Cluj, Proiectare Vestimentară, Stilism, dar și Croitorie au fost lansate de Atelierele ILBAH, cea mai bună școală de modă din România (distincție câștigată în cadrul Bucharest Fashion Week în 2017 și 2018). Ce poate fi mai frumos decât să îți urmezi pasiunea sub îndrumarea unor profesioniști care își vor da silința ca tu să reușești?

               Să reușești în modă… sună ca un vis frumos, nu? La Atelierele ILBAH vei avea parte de cea mai bună pregătire în domeniu, fie că alegi un Curs de Design Vestimentar, sau că te îndrepți către Stilism sau Croitorie..</p>
                </div>
            
                <div class="columnc l"  style="text-align:justify">
        
                  <p> Cursul de Design Vestimentar se adresează atât începătorilor, cât și pasionaților care vor să înceapă o carieră în domeniu. Ce înseamnă o carieră în domeniul creațiilor vestimentare și cât de sus te poate duce acest Curs de Design Vestimentar? Poți ajunge atât de sus, pe cât îți dorești să ajungi. Succesul în modă este despre creativitate și despre puterea hainelor de a se face remarcate.Cursul de Design Vestimentar organizat de Atelierele ILBAH te va ajuta să te descoperi din punct de vedere stilistic și te va ajuta să îți exprimi pe hârtie ideile creative.</p>
                
                </div>
  
        </div>
        
<!-------------------------------------------- BULINE----------------------------->

<div class="rowc" >


        <div class="columncourses">
          <div class="cardd" >
          <div class="round" data-aos="zoom-in" data-aos-delay="100">
                  <p><i class='far fa-calendar-alt' style='font-size:25px;'></i></p>
            </div>
                  <h4 style="padding-top:30px">ACCES PE TOATA VIATA</h4>

                
            </div>
          </div>
        

        <div class="columncourses">
          <div class="cardd">
          <div class="round" data-aos="zoom-in" data-aos-delay="200"> 
            <p><i class='fas fa-desktop' style='font-size:25px;'></i></p>
          </div>
            <h4 style="padding-top:30px">FORMAT ONLINE </h4>

          </div>
        </div>
        
        <div class="columncourses">
          <div class="cardd" data-aos="zoom-in" data-aos-delay="300">
            <div class="round"> 
          <i style='font-size:25px;'class='far'>&#xf256;</i>
          </div>
            <h4 style="padding-top:29px">TOTUL PRACTIC </h4>

          </div>
        </div>
        
        <div class="columncourses">
          <div class="cardd">
          <div class="round" data-aos="zoom-in" data-aos-delay="400"> 
            <p><i class='far fa-comment' style='font-size:25px;'></i></p>
            </div>
            <h4 style="padding-top:30px">FEEDBACK</h4>

          </div>
        </div>
  
</div>


<!-------------------------------------------- OFERTA DE CURSURI------------------------------>

<h1 class="titlecourse" id="jumptooffer"> OFERTA DE CURSURI </h1><br>
   

<hr class="curs">

<div class="content courses" >			

<?php
	include("conect.php");
		$result = $mysqli->query("SELECT * FROM cursuri");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		
     echo'<div class="responsive courses" data-aos="zoom-in" data-aos-delay="100">';
      echo'<div class="gallery">';
      echo'<a href="coursedetail.php?id='.$row->id.'">';
        echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" >';
        echo'<div class="middle courses"> <div class="textcurs"><h1>'.$row->numescurt.'</h1><p style="text-decoration:underline;padding-bottom:5px">Detalii curs</p></div>';
        echo'</div>';
        echo'</a>';
    
      echo'</div>';
    echo'</div>';


      
			
		}
	}
	echo"<div class='clearfix'></div>";
	
	$mysqli->close();
	?>



<div class="clearfix"></div>

</div> 



<!-------------------------------------------- SCRIPTS----------------------------->
<script src="js/playpausevideo.js"></script>
<script src="js/reversenavshrink.js"></script>

<script>
$(window).scroll(function(){
	$('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
}); 
</script>
<!--AOS-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="js/search.js"></script>

</body>

<?php include('footer.php'); ?>
</html>
