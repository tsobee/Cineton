<?php

if(isset($_POST["btnDelRes"])){
    include("../konekcija/konekcija.php");
    global $konekcija;

    $idZaBrisanje=$_POST["idRes"];
    $queryBrisanjeRes="DELETE FROM reservation WHERE idReservation=$idZaBrisanje";

    try{
        $execBrisanjeRes=$konekcija->query($queryBrisanjeRes);
        http_response_code(200);
        header("Location: ../../adminReservation.php?message=Successfully cancel reservation");
    }
    catch(PDOException $ex){
        http_response_code(500);
        echo("Connection error: ". $ex->getMessage());
    }
}else{
    http_response_code(404);
}
?>