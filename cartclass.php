<?php 
// Start session// daca sesiunea a inceput deja initializam inca o data
if(!session_id()){ 
    session_start(); 
}

require_once 'conect.php'; 

class Cart { 
    protected $cart_contents = array();
    protected $clientID = -1;
    protected $mysqli;
     
    public function __construct($link){ 
        $this->mysqli = $link;

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            if ($link->connect_error) {
                die("error");
            }
        
            $sql = "SELECT id FROM clienti WHERE email = ?";
        
            if ($stmt = $link->prepare($sql))
            {
                $stmt->bind_param("s", $_SESSION["email"]);
        
                $stmt->execute();
                $stmt->store_result();
        
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($this->clientID);
                    $stmt->fetch();
                }
            }
        }
    }
     
    public function contents(){ 
        $sql = 'SELECT c.id ,c.pid, p.nume, p.poza, c.marime, p.pret, c.cantitate, c.cantitate*p.pret as subtotal FROM cos AS c INNER JOIN produse AS p ON c.pid = p.id WHERE cid = ?';
        
        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("i", $this->clientID);
    
            $final = $stmt->execute();

            $result = $stmt->get_result();

            $send = array();

            $stmt->close();

            return $result;
        }
        return NULL;
    } 
     
    public function get_item($row_id){ 
        
    } 
     
 
    public function total_items(){
        $sql = "SELECT sum(cantitate) FROM cos WHERE cid = ? GROUP BY cid";
        
        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }

        $total = 0;
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("s", $this->clientID);
    
            $stmt->execute();
            $stmt->store_result();
    
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($total);
                $stmt->fetch();
            }
        }

        return $total;
    } 
     

    public function total(){ 
        $sql = "SELECT sum(p.pret*cantitate) FROM cos AS c INNER JOIN produse AS p ON c.pid = p.id WHERE cid = ? GROUP BY cid";
    
        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }

        $total = 0;
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("i", $this->clientID);
    
            $stmt->execute();
            $stmt->store_result();
    
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($total);
                $stmt->fetch();
            }
        }

        return $total;
    }
     

    public function update($id, $quan){ 
        $sql = "UPDATE cos SET cantitate = ? WHERE id = ? AND cid = ?";
    
        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("iii", $quan, $id, $this->clientID);
    
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                return "ok";
            } else {
                return "no_update";
            }
        }

        return "error";
    } 
     

    public function put_item($id, $q, $size){ 
        $sql = "INSERT INTO cos (cid, pid, cantitate, marime, comandat_pe) VALUES(?,?,?,?,CURDATE())";

        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("iiis", $this->clientID, $id, $q, $size);
    
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                return "ok";
            } else {
                return "no_update";
            }
        }

        return "error";
    } 
     

    public function remove($id){ 
        $sql = "DELETE FROM cos WHERE id = ? AND cid = ?";

        echo $id;
    
        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("ii", $id, $this->clientID);
    
            $stmt->execute();
    
            if ($stmt->affected_rows > 0) {
                return "ok";
            } else {
                return "no_update";
            }
        }

        return "error";
    } 

    public function place_order($nume, $prenume, $phone, $judet, $localitate, $adresa) {
        $sql = "CALL makeOrder(?,?,?,?,?,?,?)";
    
        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("issssss", $this->clientID, $nume, $prenume,  $phone, $judet, $localitate, $adresa);
    
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                return "ok";
            } else {
                return "error";
            }
        }

        return "error".$mysqli->error;
    }
      

    public function destroy(){ 
        $this->mysqli->close();
    } 
}