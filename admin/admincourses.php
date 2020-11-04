<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cursuri</title>
</head>

<body>

    
<?php
include("../conect.php");
?>

<?php
include("adminheader.php");
?>


<article>

<div class="title">
<span style="font-size:30px;cursor:pointer;float:left; display:none" id="opennav">&#9776; </span>
<h2> Cursuri</h2>
</div>

<div class="content courses" >			

<?php
	include("..\conect.php");
		$result = $mysqli->query("SELECT * FROM cursuri");
		if($result->num_rows > 0)
	{
        while($row=$result->fetch_object())
		{
		
     echo'<div class="responsive courses">';
      echo'<div class="gallery">';
      echo'<a href="updatecourse.php?id='.$row->id.'">';
        echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" >';
        echo'</div>';
        echo'</a>';
    
      echo'</div>';
    echo'</div>';


      
			
		}
	}
	echo"<div class='clearfix'></div>";
	
	$mysqli->close();
	?>




</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $("#email").click(function(){
    $("#emailclients").slideToggle("slow");
  });
});
</script>
<script src="../js/selectcustom.js"></script>
<script src="js/navtoggle.js"></script>
</body>
</html>