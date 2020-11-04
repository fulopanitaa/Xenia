<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
}

require_once 'conect.php'; 

class Wish { 
    protected $wish_contents = array();
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
        $sql = 'SELECT f.id, f.pid, p.nume, p.poza, p.pret FROM favorite AS f INNER JOIN produse AS p ON f.pid = p.id WHERE cid = ?';
        
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
        $sql = "SELECT count(id) FROM favorite WHERE cid = ? GROUP BY cid";
        
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
     

      
    public function put_item($id){ 
        $sql = "INSERT INTO favorite (cid, pid) VALUES(?,?)";

        $mysqli = $this->mysqli;

        if ($mysqli->connect_error) {
            die("error");
        }
    
        if ($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("ii", $this->clientID, $id);
    
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
        $sql = "DELETE FROM favorite WHERE id = ? AND cid = ?";

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
      

    public function destroy(){ 
        $this->mysqli->close();
    } 
}