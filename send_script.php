<?php

require_once('conect.php');
session_start();




if (isset($_POST['send_message_btn'])) {

    $id=$_POST['id'];
    $idclient=$_POST['idclient'];
    $email= $_POST['email'];
    $lastname = $_POST['prenume'];


//Verificam daca clientul a cumparat cursul 

    $sql="SELECT id FROM comenzi_curs WHERE idclient=? AND idcurs=?";
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("ii", $idclient, $id);
        if($stmt->execute()){
        $stmt->store_result();
        if($stmt->num_rows < 1){

            $emailxenia = "xenialicenta@gmail.com";
            $to = "xenialicenta@gmail.com";
            $subject = "Comanda curs";
            $headers = "From: $emailxenia\n";
            $message = " S-a intregistrat o noua comanda pentru un curs! .\n";
            mail($to,$subject,$message,$headers);



    
    $insert = $mysqli->query("INSERT INTO comenzi_curs (idcurs,idclient,nume) VALUES ('$id','$idclient','$lastname')") ;


$userheaders = "From: XENIA ";
//$userheaders .= "Content-type: X-Mailer: php\r\n";
$userheaders .= "MIME-Version: 1.0" . "\n";
$userheaders .= "Content-type:text/html;charset=UTF-8" . "\n";
$usersubject ="Confirmare comanda";
$usermessage = "
<html>
<head>
<title>Confirmare comanda</title>

</head>
<body>


<div style='background-color:rgb(235, 233, 226); text-align:center;  padding:40px 40px; '>
<div style='background-color:white; padding:50px 20px; border:1px solid rgb(173, 172, 172); font-family: Linden Hill; color:black; '>
<h1 style=' color:black;' >Buna $lastname,</h1>
<br>
<p style=' color:black; font-size:14px'> Bine ai venit in lumea creatiilor, unde imaginatia nu are limite. </p>
<p style=' color:black; font-size:14px'> Ti-am pregatit o serie de cursuri, cu informatii valoroase si demonstratii practice. </p>

<p style=' color:black; font-size:14px'>Pentru orice intrebari sau nelamuriri care ar putea sa
    apara te rog sa imi scrii.</p>

<button style='margin:20px; padding:10px 80px;  border:none; border-bottom:1px solid black; background-color: transparent;font-size:14px;'>
<a style='text-decoration: none; color:rgb(121, 25, 25); font-weight: bold;' href='courses\loginc.php'> INCEPE ACUM </a>
</button>

<div style='text-align:right;padding-right:10%;'>
        <p  style=' color:black; font-size:14px'> Spor la croit! </p>
        <h1 style=' color:black;'> Xenia </h1>

    </div>
</div>
</div>

</body>
</html>
";
if(mail($email,$usersubject,$usermessage,$userheaders))
{
    
    header('location: coursedetail.php?id='.$id.'');
    $_SESSION['response']="Curs comandat cu succes! Te rugam sa verifici adresa de mail, unde gasesti linkul catre platforma cu cursuri. ";
}


 }

else {

    header('location: coursedetail.php?id='.$id.'');
    $_SESSION['response']="Ai comandat deja cursul acesta, te rugam sa verifici adresa de mail sau platforma. ";
}


}
}


}?>