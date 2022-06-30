<?php

if(isset($_POST["btnDelRep"])){
    include("../konekcija/konekcija.php");
    global $konekcija;

    $idZaBrisanje=$_POST["idRep"];
    $queryBrisanjeRep="DELETE FROM repertoire WHERE idRepertoire=$idZaBrisanje";

    try{
        $execBrisanjeRep=$konekcija->query($queryBrisanjeRep);
        http_response_code(200);
        header("Location: ../../adminRep.php?message=Successfully deleted repertoire");

    }
    catch(PDOException $ex){
        http_response_code(500);
        echo("Connection error: ". $ex->getMessage());
    }
}else{
    http_response_code(404);
}
?>