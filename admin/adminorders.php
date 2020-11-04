
<?php
include('../conect.php');

?>
<!--------------------------------STERGERE-------------------------------->

<?php
include("../conect.php");
if(isset($_GET['id'])&&is_numeric($_GET['id']))
{
    $id=$_GET['id'];
   
	if($stmt=$mysqli->prepare("DELETE FROM comenzi_produse WHERE id_comanda=? LIMIT 1"))
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
<title>Colectii</title>
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
<h2> COMENZI</h2>
<span style="font-size:30px;cursor:pointer;float:left; display:none" id="opennav">&#9776; </span>




<!---------------------------------LISTARE COMENZI-------------------------------->


<div class style="overflow:auto;margin-top:20px;">


<?php
include("../conect.php");

if($result = $mysqli->query("SELECT o.id_comanda, o.id_client, o.nume AS numeclient, o.prenume AS prenumeclient, o.telefon, o.judet, o.localitate, o.adresa, c.comandat_pe, c.marime AS marimecomandata, c.cantitate AS cantitatecomandata, c.pid, p.nume, p.poza, p.pret FROM comenzi_produse AS o INNER JOIN cos AS c ON o.id_comanda = c.comanda_id INNER JOIN produse AS p ON c.cid=p.id"))
{
	if($result->num_rows > 0)
	{
		echo "<table border='1' cellpadding='10' style='width:100%;' >";
		echo "<tr><th>ID comanda</th><th>Nume produs</th><th>Poza produs</th><th>Pret</th><th>Data comenzii</th><th>Marime</th><th>Cantitate</th><th>Nume client</th><th>Prenume client</th><th>Numar de telefon</th><th>Judet</th><th>Localitate</th><th>Adresa</th><th></th></tr>";
		
		while($row=$result->fetch_object())
		{
			echo "<tr>";
			echo "<td>".$row->id_comanda."</td>";
            echo "<td>".$row->nume."</td>";
            echo '<td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row->poza).'" alt=""  height="150"></td>';
            echo "<td>".$row->pret."</td>";
            echo "<td>".$row->comandat_pe."</td>";
            echo "<td>".$row->marimecomandata."</td>";
            echo "<td>".$row->cantitatecomandata."</td>";
            echo "<td>".$row->numeclient."</td>";
            echo "<td>".$row->prenumeclient."</td>";
            echo "<td>".$row->telefon."</td>";
            echo "<td>".$row->judet."</td>";
            echo "<td>".$row->localitate."</td>";
            echo "<td>".$row->adresa."</td>";
			echo "<td><a style='text-decoration:none;color:red' href='adminorders.php?id=". $row->id_comanda."'>STERGE</a></td>";
			echo "</tr>";
		}
		
		echo"</table>";		
	}
	else
	{
		echo "Nu sunt inregistrari in tabel!";
	}
}
	
	$mysqli->close();
?>
</div>
</article>


<script src="navtoggle.js"></script>
</body>
</html>