<?php 

// verifica daca userul este logat
// caz contrar => spre login page
session_start();

if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
 header("location: login.php");
 exit;
}
// verificare END

require_once 'cartclass.php';
require_once 'conect.php';

$cart = new Cart($mysqli);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php'); ?>

<style>
#checkoutMessage .alert {
    display: none;
}
</style>

<script>
function placeOrder(event){
    event.preventDefault();
    
    $.get(
        "cartAction.php",
        {
            action : "placeOrder",
            nume : $(event.target).find('input[name="last_name"]').val(),
            prenume : $(event.target).find('input[name="first_name"]').val(),
            telefon : $(event.target).find('input[name="phone"]').val(),
            judet : $(event.target).find('input[name="judet"]').val(),
            localitate : $(event.target).find('input[name="localitate"]').val(),
            adresa : $(event.target).find('input[name="address"]').val(),
        },
        function(data){
            if(data == 'error' || data == "no_update"){
                $("#checkoutMessage .alert-success").hide();
                $("#checkoutMessage .alert-danger").show();
                $("#checkoutMessage .alert-danger").text("S-a produs o eroare.");
            } else {
                $("#checkoutMessage .alert-success").show();
                $("#checkoutMessage .alert-danger").hide();
                $("#checkoutMessage .alert-success").text("Comanda a fost plasata si urmeaza a fi procesata.");
            }

           
        }
    );
}
</script>

</head>
<body>

<!-- include navbarul peste tot -->
<?php include('navbar.php'); ?>
<!-- navbar -->

<div class="containertop" >
	<h2 style="font-family:Linden Hill;">DATE FACTURARE</h2>
	<br>
    <p>Va rugam sa introduceti datele unde doriti ca produsul sa fie livrat</p>
</div>
<div class="checkoutpage">
    <div class="col-12">
        <div class="checkout">
            <div class="row">
                <div class="col-md-12" id="checkoutMessage">
                    <div class="alert alert-success">s</div>

                    <div class="alert alert-danger">d</div>
                </div>
				
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span >COSUL TAU</span>
                        <span class="badge badge-light badge-pill"><?php echo $cart->total_items(); ?> produse</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php 
                        if($cart->total_items() > 0){ 
                            //get cart items from session 
                            $cartItems = $cart->contents(); 
                            while($item = $cartItems->fetch_assoc()){
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><b><?php echo $item["nume"]; ?></b></h6>
                                <small class="text-muted"><?php echo $item["pret"]; ?>(<?php echo $item["cantitate"]; ?>)</small>
                            </div>
                            <span class="text-muted"><?php echo $item["subtotal"].' RON'; ?></span>
                        </li>
                        <?php } } ?>
                       
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong style="font-family:LINDEN HILL"><?php echo $cart->total().' RON'; ?></strong>
                        </li>
                    </ul>
                    <a href="products.php" class="btn btn-block btn-info">Adauga produs</a>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">DETALII CLIENT</h4>
                    <form method="post" onSubmit="placeOrder(event)">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">NUME</label>
                                <input type="text" class="form-control" name="first_name"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">PRENUME</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>
                      
                        <div class="mb-3">
                            <label for="phone">NR.TELEFON</label>
                            <input type="text" class="form-control" name="phone"  required>
                        </div>
                        <div class="mb-3">
                            <label for="judet">Judet</label>
                            <input type="text" class="form-control" name="judet"  required>
                        </div>
                        <div class="mb-3">
                            <label for="localitate">Localitate</label>
                            <input type="text" class="form-control" name="localitate"  required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name">ADRESA</label>
                            <input type="text" class="form-control" name="address"  required>
                        </div>
                      
                        <input class="buttonplace" type="submit" name="checkoutSubmit" value="Plaseaza comanda">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/search.js"></script>
<?php include('footer.php'); ?>

</body>
</html>