<?php
    include("../konekcija/konekcija.php");  
    global $konekcija;

    $repertoar="";
    $code=200;
    $queryNaRepertoaru="SELECT * FROM repertoire r INNER JOIN film f ON r.idFilm=f.idFilm WHERE screeningDate>=CURRENT_DATE ORDER BY r.screeningDate LIMIT 1";

    try{
        $naRepertoaru=$konekcija->query($queryNaRepertoaru)->fetch();
    }
    catch(PDOException $e){
        $repertoar="Greška sa serverom";
        $code=500;
    }
    echo json_encode($naRepertoaru);
    http_response_code($code);
?>