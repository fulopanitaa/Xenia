<!---------ADAUGARE ORA------>

<?php 
include("../conect.php");
session_start();
$update=false;
$ora="";
$id="";

if(isset($_POST['adauga']))
{
	$ora = htmlentities($_POST['ora'],ENT_QUOTES);
		if($stmt = $mysqli->prepare("INSERT INTO orar (ora) VALUES (?)"))
		{
			$stmt->bind_param("s",$ora);
			$stmt->execute();
            $stmt->close();
            header('location: schedule.php');
			$_SESSION['response']="ADAUGAT CU SUCCES";
		}
		else
		{
			echo 'ERROR: Nu se poate executa insert.';
		} 
	
}

$mysqli->close();
?>

<!---------STERGERE------>

<?php
include("../conect.php");
if(isset($_GET['id'])&& is_numeric($_GET['id']))
{
    $id=$_GET['id'];
   
	if($stmt=$mysqli->prepare("DELETE FROM orar WHERE id=? LIMIT 1"))
	{
		$stmt->bind_param("i",$id);
		$stmt->execute();
        $stmt->close();
        header('location: schedule.php');
		$_SESSION['response']="STERS CU SUCCES";
    }
        
	else
	{
		echo "alert('ERROR:Nu se poate executa stergerea.)";
	}
	

}
$mysqli->close();
?>

<!---------MODIFICA------>

<?php
include("../conect.php");


	if(isset($_GET['edit']))
	{
			$id=$_GET['edit'];
			if($stmt = $mysqli->prepare("SELECT * FROM orar WHERE id=?"))
				{
					$stmt->bind_param("i",$id);
					$stmt->execute();
                    $result=$stmt->get_result();
                    $row=$result->fetch_assoc();
				
                    $id=$row['id'];
                    $ora=$row['ora'];
                    
                    $update=true;
			
            }
        }

    if(isset($_POST['update']))
    {

        $id=$_POST['id'];
        $ora=$_POST['ora'];

        if($stmt = $mysqli->prepare("UPDATE orar SET ora=? WHERE id='".$id."'"))
				{
					$stmt->bind_param("s",$ora);
					$stmt->execute();
					$stmt->close();
				}

                header('location: schedule.php');
                $_SESSION['response']="MODIFICAT CU SUCCES";   
    }
	
?>

