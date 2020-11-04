<?php 
// Initialize shopping cart class 
require_once 'wishclass.php';
require_once 'conect.php';

$wish = new Wish($mysqli);

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToWish' && !empty($_REQUEST['id'])){ 
        
    }
    elseif($_REQUEST['action'] == 'item_count'){ 
        echo $wish->total_items();
    }
  
    elseif($_REQUEST['action'] == 'removeItem')
    {
        echo $wish->remove($_REQUEST['id']);
    }
    elseif($_REQUEST['action'] == 'addItem')
    {
        echo $wish->put_item($_REQUEST['id']);
    }
} 
 
exit();

?>