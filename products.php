
<?php
include("conect.php");
?>

<?php 

// Initialize whishlist class 
include_once 'wishclass.php'; 
require_once 'conect.php'; 
$wish = new Wish($mysqli); 

?>




<!DOCTYPE html>
<html lang="ro">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


<?php include('header.php'); ?>
<body>
<?php include('navbar.php'); ?>
<!-- navbar -->

<div class="containertop">
        <?php if(isset($_GET['id']) && !empty($_GET['id']))
	{ 
              echo"<h2 style='font-family:Linden Hill;text-transform:uppercase'>COLECTIA ".$_GET['id']."</h2>" ;
        }
        else 
              echo "<h2 style='font-family:Linden Hill;'>ROCHII DE EVENIMENT</h2>"
        ?>  
       
	<br>
    <p>"Ceea ce purtam reprezinta modul in care ne prezentam pe noi insine lumii. Eleganta nu se traduce prin a iesi in evidenta, ci prin capacitatea de a nu te face uitat. Moda este limbajul instant universal." <p>
        
  </div>


<div class="sort">
<div class="subnav">
<div class="subnavbtn">Filtru | Sortare<i class="fa fa-plus" style="padding:0px;float:right;font-size:10px; padding-top:2px"></i></div>
<script src="js/slide_filter.js"></script>
    <div class="subnav-content">

    <form action="" method="post">
    
    <select  name="lungime">
    <option value="0" disabled selected="true"> Lungime</option>
    <?php
	
	$result = $mysqli->query("SELECT DISTINCT lungime FROM produse WHERE lungime !='' ");
	while($row=$result->fetch_object())
	{
		echo "<option value='".$row->lungime."'>".$row->lungime."</option>";
	}
	?>


        </select>
          <select class="filter" name="material">
          <option value="0" disabled selected="true"> Material </option>
         <?php
	
	$result = $mysqli->query("SELECT material1 AS materiale FROM produse WHERE material1 != '' UNION SELECT material2 FROM produse WHERE material2 !='' ");
	while($row=$result->fetch_object())
	{
		echo "<option value='".$row->materiale."'>".$row->materiale."</option>";
	}
	?>
          </select>
          <select class="filter" name="culoare">
          <option value="0" disabled selected="true"> Culoare </option>
          <?php
	
	$result = $mysqli->query("SELECT DISTINCT culoare FROM produse WHERE culoare != '' ");
	while($row=$result->fetch_object())
	{
		echo "<option value='".$row->culoare."'>".$row->culoare."</option>";
	}
        ?>
        
          </select>
          <select class="subnavbtnr" name="sort" id="sort" onchange="load_sort()">
                                        <option value="0" disabled selected="true">Sortare</option>
                                        <option value="mic">Pret (Mic->Mare)</option>
                                        <option value="mare">Pret (Mare->Mic)</option>
                                        <option value="AZ">Nume (A->Z)</option>
                                        <option value="ZA">Nume (Z->A)</option>
                                </select>
          <button type="submit" class="buttonselect">APLICA FILTRU</button>
      
          

</form>
       
</div>

</div> 

                   
            
    
</div>
</div> 
</div>
<?php 
error_reporting( error_reporting() & ~E_NOTICE );
@$lungime = $_POST['lungime'];
@$material = $_POST['material'];
@$culoare = $_POST['culoare'];
@$selected_option=$_POST['option_value'];
@$sort=$_POST['sort'];




        if(isset($_POST['lungime']) && isset($_POST['material']) && isset($_POST['culoare'])) { $qry = "SELECT * FROM produse      
        WHERE lungime='$lungime' AND (material1 = '$material' OR material2='$material') AND culoare ='$culoare'"; }
        if(isset($_POST['lungime']) && isset($_POST['material']) && $_POST['culoare']==NULL){
                $qry = "SELECT * FROM produse
        WHERE lungime='$lungime' AND material1 ='$material' OR material2='$material'";
        }
        if(isset($_POST['culoare']) && isset($_POST['material']) && $_POST['lungime']==NULL){
                $qry = "SELECT * FROM produse
        WHERE culoare =' $culoare 'AND (material1 ='$material' OR material2='$material')";
        }
        if(isset($_POST['culoare']) && isset($_POST['lungime']) && $_POST['material']==NULL){
                $qry = "SELECT * FROM produse
        WHERE culoare='$culoare' AND lungime='$lungime'";
        }
        if(isset($_POST['culoare']) && $_POST['lungime']==NULL && $_POST['material']==NULL){
                $qry = "SELECT * FROM produse
        WHERE culoare ='$culoare'";
        }
        if($_POST['culoare']==NULL && isset($_POST['lungime']) && $_POST['material']==NULL){
                $qry = "SELECT * FROM produse
        WHERE lungime ='$lungime'";
        }
        if($_POST['culoare']==NULL && $_POST['lungime']==NULL && isset($_POST['material'])){
                $qry = "SELECT  * FROM produse
         WHERE (material1 ='$material' OR material2='$material')";
        }
        if($_POST['culoare']==NULL && $_POST['lungime']==NULL && $_POST['material']==NULL){
                $qry = "SELECT * FROM produse WHERE categorie='femei'";
        }
        if(isset($_GET['id']) && !empty($_GET['id'])){

                         if(isset($_POST['lungime']) && isset($_POST['material']) && isset($_POST['culoare'])) { 
                        $qry = "SELECT * FROM produse      
                        WHERE lungime='$lungime' AND (material1 = '$material' OR material2='$material') AND culoare ='$culoare' AND colectie='".$_GET['id']."'" ; 
                        }
                        if(isset($_POST['lungime']) && isset($_POST['material']) && $_POST['culoare']==NULL){
                                $qry = "SELECT * FROM produse
                        WHERE lungime='$lungime' AND colectie='".$_GET['id']."' AND material1 ='$material' OR material2='$material'";
                        }
                        if(isset($_POST['culoare']) && isset($_POST['material']) && $_POST['lungime']==NULL){
                                $qry = "SELECT * FROM produse
                        WHERE culoare =' $culoare '  AND colectie='".$_GET['id']."' AND (material1 ='$material' OR material2='$material')";
                        }
                        if(isset($_POST['culoare']) && isset($_POST['lungime']) && $_POST['material']==NULL){
                                $qry = "SELECT * FROM produse
                        WHERE culoare='$culoare' AND lungime='$lungime' AND colectie='".$_GET['id']."'";
                        }
                        if(isset($_POST['culoare']) && $_POST['lungime']==NULL && $_POST['material']==NULL){
                                $qry = "SELECT * FROM produse
                        WHERE culoare ='$culoare' AND colectie='".$_GET['id']."'";
                        }
                        if($_POST['culoare']==NULL && isset($_POST['lungime']) && $_POST['material']==NULL){
                                $qry = "SELECT * FROM produse
                        WHERE lungime ='$lungime'  AND colectie='".$_GET['id']."'";
                        }
                        if($_POST['culoare']==NULL && $_POST['lungime']==NULL && isset($_POST['material'])){
                                $qry = "SELECT  * FROM produse
                         WHERE (material1 ='$material' OR material2='$material')  AND colectie='".$_GET['id']."'";
                        }
                        if($_POST['culoare']==NULL && $_POST['lungime']==NULL && $_POST['material']==NULL){
                                $qry = "SELECT * FROM produse WHERE colectie='".$_GET['id']."'";
                        }
               
        }

        if(isset($_POST['sort']) && $_POST['sort']=='mic' && isset($_GET['id']) && !empty($_GET['id'])) {
                $qry = "SELECT * FROM produse WHERE categorie='femei'  AND colectie='".$_GET['id']."' ORDER BY pret";

        }
        else if(isset($_POST['sort']) && $_POST['sort']=='mic'){
                $qry = "SELECT * FROM produse WHERE categorie='femei' ORDER BY pret";

        }
        if(isset($_POST['sort']) && $_POST['sort']=='mare' && isset($_GET['id']) && !empty($_GET['id'])){
                $qry = "SELECT * FROM produse WHERE categorie='femei' AND colectie='".$_GET['id']."' ORDER BY pret DESC";

        }

        else if(isset($_POST['sort']) && $_POST['sort']=='mare'){
                $qry = "SELECT * FROM produse WHERE categorie='femei' ORDER BY pret DESC";

        }
        if(isset($_POST['sort']) && $_POST['sort']=='AZ' && isset($_GET['id']) && !empty($_GET['id'])){
                $qry = "SELECT * FROM produse WHERE categorie='femei' AND colectie='".$_GET['id']."' ORDER BY nume";

        }
        else if (isset($_POST['sort']) && $_POST['sort']=='AZ'){
                $qry = "SELECT * FROM produse WHERE categorie='femei' ORDER BY nume";

        }
        if(isset($_POST['sort']) && $_POST['sort']=='ZA' && isset($_GET['id']) && !empty($_GET['id'])){
                $qry = "SELECT * FROM produse WHERE categorie='femei' AND colectie='".$_GET['id']."' ORDER BY nume DESC";
        }
        else if(isset($_POST['sort']) && $_POST['sort']=='ZA'){
                $qry = "SELECT * FROM produse WHERE categorie='femei' ORDER BY nume DESC";

        }
    

echo"<div class='produse'>";
//<a><i class='far fa-heart'>
	
      	$result = mysqli_query($mysqli,$qry);
		$num = mysqli_num_rows($result);
		  if($num > 0) while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
		
			echo "<div class='responsive'>";
			echo "<div data-aos='fade-up' class='gallery'>";
			echo"<a href='product.php?id=".$row['id']."'>";
			echo'<img class="image" src="data:image/jpeg;base64,'.base64_encode($row['poza']).'" alt=""  width="600px" height="400">';
                        echo"<div class='middle'> <div class='text'>";
                               echo" <form id='addToWishForm' onsubmit='addToWish(event)' method='POST' style='border:none;'>";
                                       echo" <input type='hidden' name='id' value='".$row['id']."'>	";
                                      
                                        echo"<input type='submit' id='heartsubmit' class='fa-heart' ' value='&#xf004' style='border:none;padding:1px;'>";
                                       
                                echo"</form>";
                        echo"</div>";
			echo "</div>";
			echo"</a>";	
			echo"</div>";
			echo"<p class='pname'>".$row['nume']."</p>";
			echo"<p class='pprice'>".$row['pret']." RON</p>";
                        echo"</div>";  
                      		
		}
      
	echo"<div class='clearfix'></div>";

	$mysqli->close();
	?>

</div>


<!-------------------------------------------- SCRIPTS----------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<script>
  AOS.init();
</script>

<script>
        $(document).ready(function(){
      // everything here will be executed once index.html has finished loading, so at the start when the user is yet to do anything.
      $("#sort").change(load_sort()); //this translates to: "when the element with id='select1' changes its value execute load_new_content() function"
});
</script>
<script>

function load_sort(){
     var selected_option_value=$("#sort option:selected").val(); //get the value of the current selected option.

     $.post("products.php", {option_value: selected_option_value}

     );
} 
</script>
<script src="js/selectcustom.js"></script>
<script src="js/wishlist.js"></script>

</body>

<?php include('footer.php'); ?>
</html>