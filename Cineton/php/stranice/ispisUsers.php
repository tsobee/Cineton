<?php
        include("php/konekcija/konekcija.php");
        global $konekcija;

        $queryIspisUsers="SELECT * FROM user u INNER JOIN  role r ON u.idRole=r.idRole";
        try{
            $execIspisUsers=$konekcija->query($queryIspisUsers)->fetchAll();
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo("Connection error: " . $ex->getMessage());
        }   
?>