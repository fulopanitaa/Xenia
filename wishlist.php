<?php 
// Initialize shopping cart class 
include_once 'wishclass.php';
require_once 'conect.php'; 
$wish = new Wish($mysqli); 
?>

<!DOCTYPE html>
<html lang="ro">
<header>

	<?php include('header.php'); ?>

<script>

	function removeItem(event){
		if(confirm("Produsul va fi sters. Continui aceasta actiune?"))
		{
			$.get(
				"wishAction.php",
				{
					action : "removeItem",
					id : $(event.target).attr("data"),
				},
				function(data){
					if(data == 'error' || data == "no_update"){
						alert('Cart update failed, please try again.');
					} else {
						location.reload();
					}
				}
			);
		}
	}
	</script>
</header>
<body>
<!-- include navbarul peste tot -->
<?php include('navbar.php'); ?>
<!-- navbar -->


<div class="containertop">
	<h2 style="font-family:Linden Hill;">FAVORITE</h2>
	<br>
</div>

 
  <div class="page-area cart-page spad">
		<div class="containercart">
			<div class="cart-table">
				<table>
					<thead>
						<tr>
							<th class="product-th">Produse</th>
							<th class="total-th"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
                            if($wish->total_items() > 0){ 
                                // Get cart items from session 
								$wishItems = $wish->contents(); 
                                while($item = $wishItems->fetch_assoc()){ 
                            ?>
					
						<tr >
							<td class="product-col" >
								
								<div class="pc-title">
								<a href='product.php?id=<?php echo $item['pid'] ?>' > <?php echo"<img src='data:image/jpeg;base64,".base64_encode($item["poza"])."'>"; ?></a>
									<h4><?php echo $item["nume"]; ?></h4>
									<p class="price-col"><?php echo $item["pret"].' RON'; ?></p>	
								</div>
							</td>
											
							<td > <button  style="border:none; font-size:16px;background-color:transparent" onclick="removeItem(event)" data="<?php echo $item["id"]; ?>"> X </button></td>
						</tr>

						<?php } }else{ ?>
							<td colspan="5"><p>Nu ai produse salvate</p></td>
                            <?php } ?>
					</tbody>
				</table>
			</div>
			<div class="row cart-buttons">
				<div>
					<a href="index.php" class="site-btn btn-line btn-update">Continua cumparaturile</a>
				</div>
			</div>
		</div>
		
	</div>
	<!-- Page end -->

</body>
<script src="js/search.js"></script>
<?php include('footer.php'); ?>
</html>