<?php
include("../conect.php");
session_start();

if(!empty($_POST['id']))
{
	if(isset($_POST['submit']))
	{
		if(is_numeric($_POST['id']) && $_POST['id'] != '')
		{
			$id=$_POST['id'];
			$nume = htmlentities($_POST['nume'],ENT_QUOTES);
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
			
			if (isset($_FILES['poza']['tmp_name']) && ($_FILES['poza']['tmp_name'])!="" && isset($_FILES['poza2']['tmp_name']) && ($_FILES['poza2']['tmp_name'])!="" && isset($_FILES['poza3']['tmp_name']) && ($_FILES['poza3']['tmp_name'])!="" ){
				
				$image = addslashes(file_get_contents($_FILES['poza']['tmp_name']));
                $image_size = getimagesize($_FILES['poza']['tmp_name']);
                $image2 = addslashes(file_get_contents($_FILES['poza2']['tmp_name']));
                $image_size2 = getimagesize($_FILES['poza2']['tmp_name']);
                $image3 = addslashes(file_get_contents($_FILES['poza3']['tmp_name']));
				$image_size3 = getimagesize($_FILES['poza3']['tmp_name']);
				if(($image_size==false) || ($image_size2==false) || ($image_size3==false)){
				//$error = 'ERROR:Fisierul ales nu este imagine!';
				}
				else{
					$update = $mysqli->query("UPDATE produse SET nume='$nume', poza='$image', poza2='$image2', poza3='$image3', material1='$material1', material2='$material2', pret='$pret', descriere='$descriere', descmaterial='$descmaterial', descintretinere='$descintretinere', masurimodel='$masurimodel',  marimi='$marimi', colectie='$colectie', culoare='$culoare', lungime='$lungime'  WHERE id='".$id."'");
					$_SESSION['response']="MODIFICAT CU SUCCESS";
				}

			}
			else
					{
				
			$update = $mysqli->query("UPDATE produse SET nume='$nume', material1='$material1', material2='$material2', pret='$pret', descriere='$descriere', descmaterial='$descmaterial', descintretinere='$descintretinere', masurimodel='$masurimodel', marimi='$marimi', colectie='$colectie', culoare='$culoare', lungime='$lungime' WHERE id='".$id."'");
			$_SESSION['response']="MODIFICAT CU SUCCES";

			}

		}
		else
		{
			echo "ID incorect!";
		}
	}
}
?>






<?php
include("adminheader.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificare</title>
</head>


<body>
<article>
<a href="adminproducts.php" class="back">Inapoi la produse </a>

<div class="title2">
		<h1> MODIFICARE PRODUS </h1>
		<hr>
	<?php if(isset($_SESSION['response'])){ ?>
	<div id="alert">
	<a type="button" class="close" >x</a>
	<b class="text-center"><?=$_SESSION['response'];?></b>
	<?php } unset($_SESSION['response'])?>
	</div>
	</div>
<div class="update">


		<div class="container">


			<form  class="form-inline" method="post" enctype="multipart/form-data">	
			
			<div>
				<?php if(isset($_GET['id']) && !empty($_GET['id']))
				{ ?>  
				<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>

			
				<?php 
			
					if($result = $mysqli->query("SELECT * FROM produse WHERE categorie='femei' AND id='".$_GET['id']."'"))
					{
						if($result->num_rows>0)
						{
							$row = $result->fetch_object(); ?>
                            </p>
                            <label for="id"><b>ID</b></label> <input readonly type="text" name="id" value="<?php echo $row->id;?>" required/><br/>
                            <label for="nume"><b>Nume</b></label> <input type="text" name="nume" value="<?php echo $row->nume; ?>" required/><br/>
                            
                            <label for="poza"><b>Poza</b></label> <br><br>
                            <?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  height="150"></td>';?><br>
                            <input type="file" name="poza" value="<?php echo base64_encode($row->poza); ?>"/><br/>
                            
                            <label for="poza2"><b>Poza2</b></label> <br><br>
                            <?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->poza2).'" alt=""  height="150"></td>';?><br>
                            <input type="file" name="poza2" value="<?php echo base64_encode($row->poza2); ?>"/><br/>
                            
                            <label for="poza3"><b>Poza3</b></label> <br><br>
                            <?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->poza3).'" alt=""  height="150"></td>';?><br>
                            <input type="file" name="poza3" value="<?php echo base64_encode($row->poza3); ?>"/><br/>
                            
                            <label for="material1"><b>Material1</b></label> <input type="text" name="material1" value="<?php echo $row->material1; ?>"/><br/>
                            <label for="material2"><b>Material2</b></label> <input type="text" name="material2" value="<?php echo $row->material2; ?>"/><br/>
							<label for="pret"><b>Pret</b></label> <input type="text" name="pret" value="<?php echo $row->pret; ?>"/><br/>
                            <label for="descriere">Descriere</label>
                            <textarea name="descriere" rows="10" cols="30" id="descriere" required><?php echo $row->descriere;?></textarea>
                            <label for="descmaterial">Descriere material</label>
                            <textarea name="descmaterial" rows="10" cols="30" id="descmaterial" required><?php echo $row->descmaterial;?></textarea>
                            <label for="descintretinere">Intretinere</label>
                            <textarea name="descintretinere" rows="10" cols="30" id="descintretinere" required><?php echo $row->descintretinere;?></textarea>
                            <label for="masurimodel">Masuri Model</label>
                            <textarea name="masurimodel" rows="10" cols="30" id="masurimodel" required><?php echo $row->masurimodel;?></textarea>
                            <label for="marimi"><b>Marimi</b></label> <input type="text" name="marimi" value="<?php echo $row->marimi; ?>"/><br/>
                            <label for="culoare"><b>Culoare</b></label> <input type="text" name="culoare" value="<?php echo $row->culoare; ?>"/><br/>
                            <label for="colectie">Colectie</label>
                            <div  class="custom-selectt"> <i class="fa fa-caret-down" style="padding-top:7px"></i>
                            <select name="colectie" id="colectie" required>   
									<?php
                                           
                                            $result = $mysqli->query("SELECT * FROM colectii");
                                            while($row=$result->fetch_object())
                                            {
                                                echo "<option value='".$row->denumire."'>".$row->denumire."</option>";
                                            }
                                            $mysqli->close();
                                            ?>
                                </select>
                                </div>
                               
                                <label for="lungime">Lungime</label>
                                <div  class="custom-selectt"> <i class="fa fa-caret-down" style="padding-top:7px"></i>
                                <select id="lungime" name="lungime" required>
                                <option value="Scurte">Scurte</option>
                                <option value="Medii">Medii</option>
                                <option value="Lungi">Lungi</option>
                                </select>
                                </div>
                            
                            
						<?php }  ?>
					<?php }  ?>
				<?php }  ?> 
					
				
			</div>
			<input type="submit" name="submit" value="MODIFICA">
		</form>
		</div><!--container
</div> <!--update-->
</article>
<script src="../js/selectcustom.js"></script>
</body>
</html>
 