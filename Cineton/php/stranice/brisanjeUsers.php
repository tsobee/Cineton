<?php

if(isset($_POST["btnDelUsers"])){
    include("../konekcija/konekcija.php");
    global $konekcija;
    $konekcija->beginTransaction();
    $idZaBrisanje=$_POST["idUser"];
    $queryBrisanjeIzAnswer="DELETE FROM answer WHERE idUser=$idZaBrisanje";
    $queryBrisanjeIzRes="DELETE FROM reservation WHERE idUser=$idZaBrisanje";
    $queryBrisanjeUser="DELETE FROM user WHERE idUser=$idZaBrisanje";

    try{
        $execBrisanjeIzAnswer=$konekcija->query($queryBrisanjeIzAnswer);
        $execBrisanjeIzRes=$konekcija->query($queryBrisanjeIzRes);
        $execBrisanjeUser=$konekcija->query($queryBrisanjeUser);
        http_response_code(200);
        header("Location: ../../adminUsers.php?message=Successfully deleted user");
        $konekcija->commit();
    }
    catch(PDOException $ex){
        $konekcija->rollback();
        http_response_code(500);
        echo("Connection error: ". $ex->getMessage());
    }
}else{
    http_response_code(404);
}
?>