<!DOCTYPE html>
<html lang="ro">
<head>
</head>
<link rel="stylesheet" type="text/css" href="stylecourses.css?rnd=132">





<body style="background-color:black">

<a class="tomainpage" href="indexc.php"> <</a>


<?php
	include("../conect.php");
		$result = $mysqli->query("SELECT * FROM cursuri WHERE id='".$_GET['id']."'");
		if($result->num_rows > 0)
	{
        $row=$result->fetch_object();
        $video1=$row->video1;
        $video2=$row->video2;
        $video3=$row->video3;
        $video4=$row->video4;
        $video5=$row->video5;
        $video6=$row->video6;
        $video7=$row->video7;
        $video8=$row->video8;
        $video9=$row->video9;
        $video10=$row->video10;
    }   
        ?>
        
<div class="containertop" style="padding:10px;padding-top:100px;background-color:white;">
<?php if(isset($_GET['id']) && !empty($_GET['id']))
	{ 
              echo"<h1 style='color:rgb(224, 220, 220)'> ".$row->nume."</h1>" ;
        }
?>
</div>





<div id="curs1" class="tabcontent">
  <h3>CURS 1</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video1."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs2" class="tabcontent">
  <h3>CURS 2</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video2."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs3" class="tabcontent">
  <h3 id="cityname" style="color:white">CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video3."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs4" class="tabcontent">
  <h3>CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video4."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs5" class="tabcontent">
  <h3>CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video5."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs6" class="tabcontent">
  <h3>CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video6."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs7" class="tabcontent">
  <h3>CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video7."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs8" class="tabcontent">
  <h3>CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()" style="height:85vh">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video8."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs9" class="tabcontent">
  <h3>CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video9."' type='video/webm'></video>"; ?>
  </div>
</div>

<div id="curs10" class="tabcontent">
  <h3 style="color:white">CURS 3</h3>
  <div class="wrapperv c" onclick="playPause()">
  <?php  echo "<video id='princess'  class='wrapper__video' controls><source src='cursuri/".$video10."' type='video/webm'></video>"; ?>
  </div>
</div>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'curs1')" id="defaultOpen">CURS 1</button>
  <button class="tablinks" onclick="openCity(event, 'curs2')">CURS 2</button>
  <button class="tablinks" onclick="openCity(event, 'curs3')">CURS 3</button>
  <button class="tablinks" onclick="openCity(event, 'curs4')">CURS 4</button>
  <button class="tablinks" onclick="openCity(event, 'curs5')">CURS 5</button>
  <button class="tablinks" onclick="openCity(event, 'curs6')">CURS 6</button>
  <button class="tablinks" onclick="openCity(event, 'curs7')">CURS 7</button>
  <button class="tablinks" onclick="openCity(event, 'curs8')">CURS 8</button>
  <button class="tablinks" onclick="openCity(event, 'curs9')">CURS 9</button>
  <button class="tablinks" onclick="openCity(event, 'curs10')">CURS 10</button>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>










</body>
</html>