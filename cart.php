<?php 


// Initialize shopping cart class 
include_once 'cartclass.php';
require_once 'conect.php'; 
$cart = new Cart($mysqli); 
?>

<!DOCTYPE html>
<html lang="ro">
<header>
	
	<?php include('header.php'); ?>

	<script>
	var timer = 0;

	function refresh()
	{
		location.reload();
	}

	function updateCartItem(event){
		clearTimeout(timer);
		
		$.get(
			"cartAction.php",
			{
				action : "updateCartItem",
				id : $(event.target).attr("data"),
				qty : $(event.target).val()
			},
			function(data){
				if(data == 'error' || data == "no_update"){
					alert('Cart update failed, please try again.');
				} else {
					timer = setTimeout(refresh, 1200);
				}
			}
		);
	}

	function removeItem(event){
		if(confirm("Produsul va fi sters. Continui aceasta actiune?"))
		{
			$.get(
				"cartAction.php",
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
<!-- navbar-->
<?php include('navbar.php'); ?>
<!-- navbar -->


<div class="containertop">
	<h2 style="font-family:Linden Hill;">COSUL TAU</h2>
	<br>
    <p>Transport gratuit peste 1000 de lei!</p>
</div>


  <div class="page-area cart-page spad">
		<div class="containercart">
			<div class="cart-table">
				<table>
					<thead>
						<tr>
							<th class="product-th">Product</th>
							<th>Marime</th>
							<th>Pret</th>
							<th>Cantitate</th>
							<th class="total-th">Subtotal</th>
						</tr>
					</thead>
					<tbody>
					<?php 
                            if($cart->total_items() > 0){ 
                                // Get cart items from session 
								$cartItems = $cart->contents(); 

                                while($item = $cartItems->fetch_assoc()){ 
                            ?>
					
						<tr>
							<td class="product-col">
								
								<div class="pc-title">
								<a href="product.php?id=<?php echo $item["pid"]; ?>" > <?php echo"<img src='data:image/jpeg;base64,".base64_encode($item["poza"])."'>"; ?></a>
									<h4><?php echo $item["nume"]; ?></h4>
								
								</div>
							</td>
							<td class="price-col"><?php echo $item["marime"]; ?></td>
							<td class="price-col"><?php echo $item["pret"].' RON'; ?></td>
							<td class="quy-col">
								<div class="quy-input">
									<input type="number" min="1" value="<?php echo $item["cantitate"]; ?>" onchange="updateCartItem(event)" data="<?php echo $item["id"]; ?>">
								</div>
							</td>
							
							<td class="total-col"><?php echo $item["subtotal"].' RON'; ?></td>
							<td> <button  onclick="removeItem(event)" data="<?php echo $item["id"]; ?>"> X </button></td>
						</tr>

						<?php } }else{ ?>
							<td colspan="5"><p>Cosul este gol</p></td>
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
		<div class="card-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="order-info">
							<h4> Timpul de procesare al comenzii:</h4> <br>
							<p>Expedierea comenzii pentru produsele aflate în stoc se va realiza în termen de 24 ore (5-7 zile lucratoare pentru rochiile pe comanda) de la confirmarea comenzii, prin email. Comanda ar trebui să ajungă la dumneavoastră în termen de aproximativ 4 zile lucratoare de la data confirmării comenzii.

Comanda va fi expediată în ambalaje care să asigure securitatea transportului. Răspunderea pentru orice deteriorare cauzată în timpul transportului produsului, coletului sau pachetului trimis de către noi, revine transportatorului conform legislației locale în vigoare.</p>

							
						</div>
					</div>
					<div class="offset-lg-2 col-lg-6">
						<div class="cart-total-details">
							<h4>Cos total</h4>
							<br>
						
							<ul class="cart-total-card">
								<br><br><br>
								<?php if($cart->total_items() > 0){ ?>
								<li class="total">Total
							
								<span><?php echo $cart->total().' RON'; ?></span></li>
							</ul>
							<?php } ?>
						
							<a href="checkout.php" class="site-btn btn-full" >Finalizare comanda</a>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page end -->

</body>
<script src="js/search.js"></script>
<?php include('footer.php'); ?>
</html>