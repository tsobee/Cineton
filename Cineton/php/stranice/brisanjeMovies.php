<?php

if(isset($_POST["btnDelMovies"])){
    include("../konekcija/konekcija.php");
    global $konekcija;
    $konekcija->beginTransaction();
    $idZaBrisanje=$_POST["idMovies"];
    $queryBrisanjeIzPrice="DELETE FROM price WHERE idFilm=$idZaBrisanje";
    $queryBrisanjeIzRep="DELETE FROM repertoire WHERE idFilm=$idZaBrisanje";
    $queryBrisanjeFilm="DELETE FROM film WHERE idFilm=$idZaBrisanje";

    try{
        $execBrisanjeIzPrice=$konekcija->query($queryBrisanjeIzPrice);
        $execBrisanjeIzRep=$konekcija->query($queryBrisanjeIzRep);
        $execBrisanjeFilm=$konekcija->query($queryBrisanjeFilm);
        http_response_code(200);
        header("Location: ../../adminMovies.php?message=Successfully deleted movie");
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