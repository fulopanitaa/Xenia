<?php 
// Initialize shopping cart class 
require_once 'cartclass.php';
require_once 'conect.php';

$cart = new Cart($mysqli);

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){ 
        
    }
    elseif($_REQUEST['action'] == 'item_count'){ 
        echo $cart->total_items();
    }
    elseif($_REQUEST['action'] == 'updateCartItem')
    {
        echo $cart->update($_REQUEST['id'], $_REQUEST['qty']);
    }
    elseif($_REQUEST['action'] == 'removeItem')
    {
        echo $cart->remove($_REQUEST['id']);
    }
    elseif($_REQUEST['action'] == 'addItem')
    {
        echo $cart->put_item($_REQUEST['id'], $_REQUEST['cantitate'], $_REQUEST['marime']);
    }
    elseif($_REQUEST['action'] == 'placeOrder')
    {
        echo $cart->place_order($_REQUEST['nume'], $_REQUEST['prenume'], $_REQUEST['telefon'], $_REQUEST['judet'], $_REQUEST['localitate'], $_REQUEST['adresa']);
    }
} 
 
exit();

?>