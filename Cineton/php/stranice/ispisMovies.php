<?php
        include("php/konekcija/konekcija.php");
        global $konekcija;

        $queryIspisMovies="SELECT * FROM film f INNER JOIN price p ON f.idFilm=p.idFilm";
        try{
            $execIspisMovies=$konekcija->query($queryIspisMovies)->fetchAll();
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo("Connection error: " . $ex->getMessage());
        }
        
?>