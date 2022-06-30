<?php
        include("php/konekcija/konekcija.php");
        global $konekcija;

        $queryIspisRes="SELECT * FROM reservation r INNER JOIN user u 
        ON r.idUser=u.idUser INNER JOIN repertoire rep 
        ON r.idRepertoire=rep.idRepertoire INNER JOIN film f 
        ON rep.idFilm=f.idFilm";
        try{
            $execIspisRes=$konekcija->query($queryIspisRes)->fetchAll();
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo("Connection error: " . $ex->getMessage());
        }   
?>