<?php
        include("php/konekcija/konekcija.php");
        global $konekcija;

        $queryIspisPoruka="SELECT * FROM message";
        try{
            $execIspisPoruka=$konekcija->query($queryIspisPoruka)->fetchAll();
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo("Connection error: " . $ex->getMessage());
        }     
?>