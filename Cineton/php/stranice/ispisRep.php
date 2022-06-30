<?php
        include("php/konekcija/konekcija.php");
        global $konekcija;

        $queryIspisRep="SELECT * FROM repertoire r INNER JOIN  film f ON r.idFilm=f.idFilm";
        try{
            $execIspisRep=$konekcija->query($queryIspisRep)->fetchAll();
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo("Connection error: " . $ex->getMessage());
        }        
?>