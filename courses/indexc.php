
<?php

require_once('../conect.php');

session_start();

$idclient=$_SESSION["id"];

?>


<!DOCTYPE html>
<html lang="ro">
<head>
</head>
<link rel="stylesheet" type="text/css" href="stylecourses.css">


<body style="background-color:white">



<div class="wrapperv" onclick="playPause()">

   <video id="princess"   autoplay muted loop class="wrapper__video">
      <source src="poze/fashionshow.mp4">
   </video>
   <div class="logout"> <a href="courses_logout.php"> Iesi din cont </a></div>
   <div class="overlaylogin"> <a id="login"> <?php echo $_SESSION["email"] ?> </a></div>
  <hr class="overlayhr">
   <div class="overlayvideo">
        <p id="title"> Xenia Design </p>
    
        <p style="width:40%; line-height:1.6">Bine ai venit in lumea creatiilor, unde imaginatia nu are limite.

Ti-am pregatit o serie de cursuri, cu informatii valoroase si demonstratii practice.

Pentru orice intrebari sau nelamuriri care ar putea sa apara te rog sa imi scrii.</p>
        <a class="start"href="#jump"> INCEPE ACUM</a>
    </div>
   

</div>

<div class="hi">
<h1 style="text-transform:uppercase" id="jump">BINE AI VENIT,  <?php echo $_SESSION["prenume"] ?> ! </h1>
<p style="color:black"> CURSURILE TALE</p>
<hr>
</div>


<div class="content courses" >			

<?php 

$result = $mysqli->query("SELECT p.idcurs, c.id, c.coperta FROM comenzi_curs AS p INNER JOIN cursuri AS c ON p.idcurs=c.id WHERE idclient= $idclient ORDER BY idcurs");
if($result->num_rows > 0)
{
    while($row=$result->fetch_object())
{


  echo' <div class="responsive" data-aos="zoom-in" data-aos-delay="100">';
  echo'<div class="gallery">';
    echo'<a href="course.php?id='.$row->idcurs.'">';
    echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" alt="" >';

    echo'<div class="middle courses"> <div class="textcurs"><p style="padding-bottom:5px">INCEPE CURSUL</p></div>';
    echo'</div>';
    echo'</a>';

  echo'</div>';
  echo'</div>';
  echo'<br>';
  echo'<br>';
  

}
}
echo"<div class='clearfix'></div>";

$mysqli->close();
?>


 

</div>



<div class="clearfix"></div>

</div> 






<script src="js/playpausevideo.js"></script>
</body>

</html>