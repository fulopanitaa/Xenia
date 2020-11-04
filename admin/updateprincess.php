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
			$pret = htmlentities($_POST['pret'],ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'],ENT_QUOTES);
            $descmaterial = htmlentities($_POST['descmaterial'],ENT_QUOTES);
			$descintretinere = htmlentities($_POST['descintretinere'],ENT_QUOTES);
			$marimi = htmlentities($_POST['marimi'],ENT_QUOTES);
			
			if (isset($_FILES['poza']['tmp_name']) && ($_FILES['poza']['tmp_name'])!=""){
				
				$image = addslashes(file_get_contents($_FILES['poza']['tmp_name']));
				$image_size = getimagesize($_FILES['poza']['tmp_name']);
				if($image_size==false){
				//$error = 'ERROR:Fisierul ales nu este imagine!';
				}
				else{
					$update = $mysqli->query("UPDATE produse SET nume='$nume', poza='$image', pret='$pret', descriere='$descriere', descmaterial='$descmaterial', descintretinere='$descintretinere', marimi='$marimi' WHERE id='".$id."'");
					$_SESSION['response']="MODIFICAT CU SUCCESS";
				}

			}
			else
					{
				
			$update = $mysqli->query("UPDATE produse SET nume='$nume', pret='$pret', descriere='$descriere', descmaterial='$descmaterial', descintretinere='$descintretinere', marimi='$marimi' WHERE id='".$id."'");
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

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificare</title>
</head>


<body>
<article>
<a href="adminprincess.php" class="back">Inapoi la produse </a>

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
			
					if($result = $mysqli->query("SELECT * FROM produse WHERE categorie='fetite' AND id='".$_GET['id']."'"))
					{
						if($result->num_rows>0)
						{
							$row = $result->fetch_object(); ?>
                            </p>
                            <label for="id"><b>ID</b></label> <input readonly type="text" name="id" value="<?php echo $row->id;?>" required/><br/>
							<label for="nume"><b>Nume</b></label> <input type="text" name="nume" value="<?php echo $row->nume; ?>" required/><br/>
							<label for="poza"><b>Poza</b></label> <input type="file" name="poza" value="<?php echo base64_encode($row->poza); ?>"/><br/>
							<?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  height="150"></td>';?><br>
							<label for="pret"><b>Pret</b></label> <input type="text" name="pret" value="<?php echo $row->pret; ?>"/><br/>
                            <label for="descriere">Descriere</label>
                            <textarea name="descriere" rows="10" cols="30" id="descriere" required><?php echo $row->descriere;?></textarea>
                            <label for="descmaterial">Descriere material</label>
                            <textarea name="descmaterial" rows="10" cols="30" id="descmaterial" required><?php echo $row->descmaterial;?></textarea>
                            <label for="descintretinere">Intretinere</label>
							<textarea name="descintretinere" rows="10" cols="30" id="descintretinere" required><?php echo $row->descintretinere;?></textarea>
							<label for="marimi"><b>Marimi</b></label> <input type="text" name="marimi" value="<?php echo $row->marimi; ?>" required/><br/>
							
						<?php }  ?>
					<?php }  ?>
				<?php }  ?> 
					
				
			</div>
			<input type="submit" name="submit" value="MODIFICA">
		</form>
		</div><!--container
</div> <!--update-->
</article>
</body>
</html>
 