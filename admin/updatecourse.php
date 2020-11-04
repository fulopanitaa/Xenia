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
			$numescurt = htmlentities($_POST['numescurt'],ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'],ENT_QUOTES);
            $modul1_titlu = htmlentities($_POST['modul1_titlu'],ENT_QUOTES);
            $modul1 = htmlentities($_POST['modul1'],ENT_QUOTES);
            $modul2_titlu = htmlentities($_POST['modul2_titlu'],ENT_QUOTES);
            $modul2 = htmlentities($_POST['modul2'],ENT_QUOTES);
            $modul3_titlu = htmlentities($_POST['modul3_titlu'],ENT_QUOTES);
            $modul3 = htmlentities($_POST['modul3'],ENT_QUOTES);
            $tarif = htmlentities($_POST['tarif'],ENT_QUOTES);
            $video1 = htmlentities($_POST['video1'],ENT_QUOTES);
            $video2 = htmlentities($_POST['video2'],ENT_QUOTES);
            $video3 = htmlentities($_POST['video3'],ENT_QUOTES);
            $video4 = htmlentities($_POST['video4'],ENT_QUOTES);
            $video5 = htmlentities($_POST['video5'],ENT_QUOTES);
            $video6 = htmlentities($_POST['video6'],ENT_QUOTES);
            $video7 = htmlentities($_POST['video7'],ENT_QUOTES);
            $video8 = htmlentities($_POST['video8'],ENT_QUOTES);
            $video9 = htmlentities($_POST['video9'],ENT_QUOTES);
            $video10 = htmlentities($_POST['video10'],ENT_QUOTES);
		
			
			if (isset($_FILES['coperta']['tmp_name']) && ($_FILES['coperta']['tmp_name'])!="" && isset($_FILES['copertamica']['tmp_name']) && ($_FILES['copertamica']['tmp_name'])!=""   ){
				
				$image = addslashes(file_get_contents($_FILES['coperta']['tmp_name']));
                $image_size = getimagesize($_FILES['coperta']['tmp_name']);
                $image2 = addslashes(file_get_contents($_FILES['copertamica']['tmp_name']));
				$image_size2 = getimagesize($_FILES['copertamica']['tmp_name']);
				if($image_size==false || $image_size2==false){
				//$error = 'ERROR:Fisierul ales nu este imagine!';
				}
				else{
					$update = $mysqli->query("UPDATE cursuri SET nume='$nume', numescurt='$numescurt', coperta='$image', copertamica='$image2', descriere='$descriere', modul1_titlu='$modul1_titlu', modul1='$modul1', modul2_titlu='$modul2_titlu', modul2='$modul2', modul3_titlu='$modul3_titlu', modul3='$modul3', tarif='$tarif', video1='$video1', video2='$video2', video3='$video3', video4='$video4', video5='$video5', video6='$video6', video7='$video7', video8='$video8', video9='$video9', video10='$video10' WHERE id='".$id."'");
					$_SESSION['response']="MODIFICAT CU SUCCESS";
				}

			}
			else
					{
				
			$update = $mysqli->query("UPDATE cursuri SET nume='$nume', numescurt='$numescurt', descriere='$descriere', modul1_titlu='$modul1_titlu', modul1='$modul1', modul2_titlu='$modul2_titlu', modul2='$modul2', modul3_titlu='$modul3_titlu', modul3='$modul3', tarif='$tarif', video1='$video1', video2='$video2', video3='$video3', video4='$video4', video5='$video5', video6='$video6', video7='$video7', video8='$video8', video9='$video9', video10='$video10' WHERE id='".$id."'");
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
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificare</title>
</head>


<body>
<article>
<a href="admincourses.php" class="back">Inapoi la cursuri </a>

<div class="title2">
		<h1> MODIFICARE CURS</h1>
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
			
					if($result = $mysqli->query("SELECT * FROM cursuri WHERE id='".$_GET['id']."'"))
					{
						if($result->num_rows>0)
						{
							$row = $result->fetch_object(); ?>
                            </p>
                            <label for="id"><b>ID</b></label> <input readonly type="text" name="id" value="<?php echo $row->id;?>" required/><br/>
                            <label for="nume"><b>Nume</b></label> <input type="text" name="nume" value="<?php echo $row->nume; ?>" required/><br/>
                            <label for="numescurt"><b>Nume scurt (Curs X)</b></label> <input type="text" name="numescurt" value="<?php echo $row->numescurt; ?>" required/><br/>
							<label for="coperta"><b>Coperta</b></label> <input type="file" name="coperta" value="<?php echo base64_encode($row->coperta); ?>"/><br/>
                            <?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->coperta).'" alt=""  height="150"></td>';?><br>
                            <label for="copertamica"><b>Coperta mica</b></label> <input type="file" name="copertamica" value="<?php echo base64_encode($row->copertamica); ?>"/><br/>
							<?php echo'<img style="margin-bottom:20px" src="data:image/jpeg;base64,'.base64_encode($row->copertamica).'" alt=""  height="150"></td>';?><br>
                            <label for="descriere">Descriere</label>
                            <textarea name="descriere" rows="10" cols="30" id="descriere" required><?php echo $row->descriere;?></textarea>
                            <label for="modul1_titlu"><b>Titlul modul 1</b></label> <input type="text" name="modul1_titlu" value="<?php echo $row->modul1_titlu; ?>" required/><br/>
                            <label for="modul1">Modul 1</label>
                            <textarea name="modul1" rows="10" cols="30" id="modul1" required><?php echo $row->modul1;?></textarea>
                            <label for="modul2_titlu"><b>Titlul modul 2</b></label> <input type="text" name="modul2_titlu" value="<?php echo $row->modul2_titlu; ?>" required/><br/>
                            <label for="modul1">Modul 2</label>
                            <textarea name="modul2" rows="10" cols="30" id="descriere" required><?php echo $row->modul2;?></textarea>
                            <label for="modul3_titlu"><b>Titlul modul 3</b></label> <input type="text" name="modul3_titlu" value="<?php echo $row->modul3_titlu; ?>" required/><br/>
                            <label for="modul1">Modul 3</label>
                            <textarea name="modul3" rows="10" cols="30" id="descriere" required><?php echo $row->modul2;?></textarea>
                            <label for="tarif"><b>Nume</b></label> <input type="number" name="tarif" value="<?php echo $row->tarif; ?>" required/><br/>
                            <label for="video1"><b>Video 1</b></label> <input type="text" name="video1" value="<?php echo $row->video1; ?>" required/><br/>
                            <label for="video2"><b>Video 2</b></label> <input type="text" name="video2" value="<?php echo $row->video2; ?>" required/><br/>
                            <label for="video3"><b>Video 3</b></label> <input type="text" name="video3" value="<?php echo $row->video3; ?>" required/><br/>
                            <label for="video4"><b>Video 4</b></label> <input type="text" name="video4" value="<?php echo $row->video4; ?>" required/><br/>
                            <label for="video5"><b>Video 5</b></label> <input type="text" name="video5" value="<?php echo $row->video5; ?>" required/><br/>
                            <label for="video6"><b>Video 6</b></label> <input type="text" name="video6" value="<?php echo $row->video6; ?>" required/><br/>
                            <label for="video1"><b>Video 7</b></label> <input type="text" name="video7" value="<?php echo $row->video7; ?>" required/><br/>
                            <label for="video1"><b>Video 8</b></label> <input type="text" name="video8" value="<?php echo $row->video8; ?>" required/><br/>
                            <label for="video1"><b>Video 9</b></label> <input type="text" name="video9" value="<?php echo $row->video9; ?>" required/><br/>
                            <label for="video1"><b>Video 10</b></label> <input type="text" name="video10" value="<?php echo $row->video10; ?>" required/><br/>
                          
							
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
 