<?php

require_once("conect.php");

if(!isset($_GET['data']) && $_GET['data'] == "")
{
    echo "Nu ai ales data";
} else {
    $sql = "SELECT ora FROM orar O WHERE O.ora NOT IN (SELECT P.ora FROM programari P WHERE ziua = ?) ORDER BY O.ora ASC";

    if ($mysqli->connect_error) {
        die("error");
    }

    if ($stmt = $mysqli->prepare($sql))
    {
        $stmt->bind_param("s", $_GET["data"]);

        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_array())
        {
      
            echo $row['ora']." ";
        }
    }

    $mysqli->close();
}

?>