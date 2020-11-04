<?php

include("conect.php");

session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if ($mysqli->connect_error) {
        die("error");
    }

    $sql = "SELECT prenume FROM clienti WHERE email = ?";

    if ($stmt = $mysqli->prepare($sql))
    {
        $stmt->bind_param("s", $_SESSION["email"]);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($name);
            $stmt->fetch();
  
            if($name != "")
            {
                echo $name;
            } else {
                echo $_SESSION["email"];
            }
        } else {
            echo $_SESSION["email"];
        }
    } else {
        echo $_SESSION["email"];
    }

    $mysqli->close();
} else {
    echo "";
}



?>
