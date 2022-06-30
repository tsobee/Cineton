<?php
    include("../konekcija/konekcija.php");  
    global $konekcija;

    $filmovi="";
    $queryIspisFilmova="SELECT * FROM film";

    try{
        $ispisFilmova=$konekcija->query($queryIspisFilmova)->fetchAll();
    }
    catch(PDOException $e){
        $filmovi="Greška sa serverom";
        $code=500;
    }
    echo json_encode($ispisFilmova);
    http_response_code(200);
?>