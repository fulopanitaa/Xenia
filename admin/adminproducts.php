<!--------------------------------ADD PRODUS-------------------------------->
<?php
include('../conect.php');
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nume = htmlentities($_POST['nume'],ENT_QUOTES);
    $file = $_FILES['poza']['tmp_name'];
    $file2 = $_FILES['poza2']['tmp_name'];
    $file3 = $_FILES['poza3']['tmp_name'];
    $material1 = htmlentities($_POST['material1'],ENT_QUOTES);
    $material2 = htmlentities($_POST['material2'],ENT_QUOTES);
    $pret = htmlentities($_POST['pret'],ENT_QUOTES);
    $descriere= htmlentities($_POST['descriere'],ENT_QUOTES);
    $descmaterial = htmlentities($_POST['descmaterial'],ENT_QUOTES);
    $descintretinere = htmlentities($_POST['descintretinere'],ENT_QUOTES);
    $masurimodel = htmlentities($_POST['masurimodel'],ENT_QUOTES);
    $marimi = htmlentities($_POST['marimi'],ENT_QUOTES);
    $colectie = htmlentities($_POST['colectie'],ENT_QUOTES);
    $culoare = htmlentities($_POST['culoare'],ENT_QUOTES);
    $lungime= htmlentities($_POST['lungime'],ENT_QUOTES);
    $categorie= htmlentities($_POST['categorie'],ENT_QUOTES);

		    $image = addslashes(file_get_contents($_FILES['poza']['tmp_name']));
        $image_size = getimagesize($_FILES['poza']['tmp_name']);
        $image2 = addslashes(file_get_contents($_FILES['poza2']['tmp_name']));
        $image_size2 = getimagesize($_FILES['poza2']['tmp_name']);
        $image3 = addslashes(file_get_contents($_FILES['poza3']['tmp_name']));
		    $image_size3 = getimagesize($_FILES['poza3']['tmp_name']);
		
	/*	if($image_size==false || $image_size2==false || $image_size3=false){
		$error = 'ERROR:Fisierul ales nu este imagine!';
}
else{*/

  $insert = $mysqli->query("INSERT INTO produse (nume,poza, poza2, poza3,material1, material2, pret,descriere,descmaterial, descintretinere, masurimodel,marimi, colectie, culoare, lungime,categorie) VALUES ('$nume','$image','$image2','$image3','$material1','$material2','$pret','$descriere','$descmaterial','$descintretinere','$masurimodel','$marimi','$colectie','$culoare','$lungime','$categorie')") or die("Problem uploading image.");
  

}
$mysqli->close();
?>
<!--------------------------------ADD COLECTIE-------------------------------->

<!--------------------------------STERGERE-------------------------------->

<?php
include("../conect.php");
if(isset($_GET['id'])&& is_numeric($_GET['id']))
{
    $id=$_GET['id'];
   
	if($stmt=$mysqli->prepare("DELETE FROM produse WHERE id=? LIMIT 1"))
	{
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
    }
        
	else
	{
		echo "alert('ERROR:Nu se poate executa stergerea.)";
	}
	

}

?>
<!--------------------------------STERGERE-------------------------------->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PRODUSE</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>

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
<h2> PRODUSE</h2>
</div>
<!--------------------------------ADAUGARE PRODUS-------------------------------->

<div id="addcollection"> 
<div id="hide">
<?php
if($error!='')
{
	echo "<div style='padding:4px;border:1px solid red'>".$error."</div>";
}
?>
<div class="container">
                <form  method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="column" >
                       
                    <label for="nume"><b>Nume</b></label>
                    <input type="text" id="nume" name="nume" required>

                    <label for="poza">Poza</label>
                    <input type="file" required name="poza" id="poza" value=""  />

                    <label for="poza">Poza2</label>
                    <input type="file" required name="poza2" id="poza2" value=""  />

                    <label for="poza">Poza3</label>
                    <input type="file" required name="poza3" id="poza3" value=""  />

                    <label for="material1">Material</label>
                    <input type="text" id="material1" name="material1" required >

                    <label for="material2">Material2</label>
                    <input type="text" id="material2" name="material2"  >

                    <label for="pret">Pret</label>
                    <input type="number" id="pret" name="pret" required >

                    <label for="descriere">Descriere</label>
                    <textarea name="descriere" rows="10" cols="30" id="descriere" required></textarea>



                    </div>
                    <div class="column" >
                    <label for="descmaterial">Descriere material</label>
                    <textarea name="descmaterial" required rows="10" cols="30" id="descmaterial"></textarea>

                    <label for="descintretinere">Intretinere</label>
                    <textarea name="descintretinere" required rows="10" cols="30" id="descintretinere"></textarea>

                    <label for="masurimodel">Masurimodel </label>
                    <input type="text" id="masurimodel" name="masurimodel" required>

                    <label for="masurimodel">Marimi  </label>
                    <input type="text" id="marimi" name="marimi" required>

                    <label for="colectie">Colectie</label>
                    <div  class="custom-selectt"> <i class="fa fa-caret-down" style="padding-top:7px"></i>
                            <select name="colectie" id="colectie" required>   
									<?php
                                            include("../conect.php");
                                            $result = $mysqli->query("SELECT * FROM colectii");
                                            while($row=$result->fetch_object())
                                            {
                                                echo "<option value='".$row->denumire."'>".$row->denumire."</option>";
                                            }
                                            ?>
								</select>
                    </div>

                    <label for="colectie">Culoare</label>
                    <input type="text" id="culoare" name="culoare" required>

                    <label for="lungime">Lungime</label>
                    <div  class="custom-selectt"> <i class="fa fa-caret-down" style="padding-top:7px"></i>
                    <select id="lungime" name="lungime" required>
                      <option value="Scurte">Scurte</option>
                      <option value="Medii">Medii</option>
                      <option value="Lungi">Lungi</option>
                    </select>
                    </div>
                     <input type="hidden" id="categorie" name="categorie" value='femei'>
                 
                    </div>

                 </div><!--row-->
                    <input type="submit" value="TRIMITE">
                </form>

                </div><!--container-->
</div><!--hide-->
   <button href="addcollection.php" class="add">ADAUGA PRODUS</button>

</div> 




<!---------------------------------LISTARE COLECTII-------------------------------->


<div class style="overflow:auto;margin-top:20px">


<?php
include("../conect.php");

if($result = $mysqli->query("SELECT * FROM produse WHERE categorie='femei' "))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID</th><th>Nume</th><th>Poza</th><th>Poza2</th><th>Poza3</th><th>Material1</th><th>Material2</th><th>Pret</th><th>Descriere</th><th>Descriere Material</th> <th>Intretinere</th> <th>Masuri Model</th>   <th>Marimi</th>  <th>Colectie</th> <th>Culoare</th> <th>Lungime</th><th>Categorie</th><th></th> <th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id."</td>";
			echo "<td>".$row->nume."</td>";
            echo '<td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  height="150"></td>';
            echo '<td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza2).'" alt=""  height="150"></td>';
            echo '<td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza3).'" alt=""  height="150"></td>';
            echo "<td>".$row->material1."</td>";
            echo "<td>".$row->material2."</td>";
            echo "<td>".$row->pret."</td>";
            echo "<td>".$row->descriere."</td>";
            echo "<td>".$row->descmaterial."</td>";
            echo "<td>".$row->descintretinere."</td>";
            echo "<td>".$row->masurimodel."</td>";
            echo "<td>".$row->marimi."</td>";
            echo "<td>".$row->colectie."</td>";
            echo "<td>".$row->culoare."</td>";
            echo "<td>".$row->lungime."</td>";
            echo "<td>".$row->categorie."</td>";
			echo "<td><a onclick='openNav()' style='text-decoration:none;color:blue' href='updateproducts.php?id=".$row->id."'>MODIFICA</a></td>";
			echo "<td><a style='text-decoration:none;color:red' href='adminproducts.php?id=". $row->id."'>STERGE</a></td>";
			echo "</tr>";
		}
		
		echo"</table>";		
	}
	else
	{
		echo "Nu sunt inregistrari in tabela!";
	}
}
	
	$mysqli->close();
?>
</div>
</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $(".add").click(function(){
    $("#hide").slideToggle("slow");
  });
});
</script>
<script src="../js/selectcustom.js"></script>
<script src="js/navtoggle.js"></script>
</body>
</html>