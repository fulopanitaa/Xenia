



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
			$denumire = htmlentities($_POST['denumire'],ENT_QUOTES);
			$creat = htmlentities($_POST['creat'],ENT_QUOTES);

			
			if (isset($_FILES['coperta']['tmp_name']) && ($_FILES['coperta']['tmp_name'])!=""){
				
				$image = addslashes(file_get_contents($_FILES['coperta']['tmp_name']));
				$image_size = getimagesize($_FILES['coperta']['tmp_name']);
				if($image_size==false){
				//$error = 'ERROR:Fisierul ales nu este imagine!';
				}
				else{
					$update = $mysqli->query("UPDATE colectii SET denumire='$denumire',coperta='$image', creat='$creat' WHERE id='".$id."'");
					$_SESSION['response']="MODIFICAT CU SUCCESS";
				}

			}
			else
					{
				
			$update = $mysqli->query("UPDATE colectii SET denumire='$denumire', creat='$creat' WHERE id='".$id."'");
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
<a href="admincollections.php" class="back">Inapoi la colectii </a>

<div class="title2">\
<span style="font-size:30px;cursor:pointer;float:left; display:none" id="opennav">&#9776; </span>
		<h1> MODIFICARE COLECTIE </h1>
		
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
			
					if($result = $mysqli->query("SELECT * FROM colectii WHERE id='".$_GET['id']."'"))
					{
						if($result->num_rows>0)
						{
							$row = $result->fetch_object(); ?>
                            </p>
                            <label for="id"><b>ID</b></label> <input readonly type="text" name="id" value="<?php echo $row->id;?>" required/><br/>
							<label for="denumire"><b>Denumire</b></label> <input type="text" name="denumire" value="<?php echo $row->denumire; ?>" required/><br/>
							<label for="coperta"><b>Coperta</b></label> <input type="file" name="coperta" value="<?php echo base64_encode($row->coperta); ?>"/><br/>
							<?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" alt=""  height="150"></td>';?><br>
							<label for="creat"><b>Creat</b></label> <input type="datetime" name="creat" value="<?php echo $row->creat; ?>"/><br/>
						<?php }  ?>
					<?php }  ?>
				<?php }  ?> 
					
				
			</div>
			<input type="submit" name="submit" value="MODIFICA">
		</form>
		</div><!--container
</div> <!--update-->
</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="js/navtoggle.js"></script>
</body>
</html>
