<?php

if(isset($_POST["btnDeleteMsg"])){
    include("../konekcija/konekcija.php");
    global $konekcija;

    $idZaBrisanje=$_POST["idPoruke"];
    $queryBrisanjeMess="DELETE FROM message WHERE idMessage=$idZaBrisanje";

    try{
        $execBrisanjeMess=$konekcija->query($queryBrisanjeMess);
        http_response_code(200);
        header("Location: ../../adminMess.php");

    }
    catch(PDOException $ex){
        http_response_code(500);
        echo("Connection error: ". $ex->getMessage());
    }
}else{
    http_response_code(404);
}
?>