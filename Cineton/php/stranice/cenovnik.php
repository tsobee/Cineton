<?php

    include("../konekcija/konekcija.php");  
    global $konekcija; 

    $data="";
    $queryCena="SELECT * FROM price p INNER JOIN film f on p.idFilm=f.idFilm";

    try{
        $data=$konekcija->query($queryCena)->fetchAll();
    }
    catch(PDOException $e){
        $data=$e->getMessage();
        $kod=500;
    }

echo json_encode($data);
http_response_code(200);

?>