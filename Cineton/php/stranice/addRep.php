<?php
    if(isset($_POST["btnAdd"])){
        include("../konekcija/konekcija.php");
        global $konekcija;

        $greske=[];
        $id = $_POST["film"];
        $d = $_POST["dan"];
        $m = $_POST["mesec"];
        $g = $_POST["god"];

        if(empty($id)){
            array_push($greske, "Can not be empty");
        }
        if((int)$d <= 0 && (int)$d > 31){
            array_push($greske, "Incorrect");
        }
        if((int)$m<= 0 && (int)$m > 12){
            array_push($greske, "Incorrect");
        }
        if((int)$g < 2022 && (int)$g > 2032){
            array_push($greske, "Incorrect");
        }

        if(count($greske) == 0)
        {
            $queryDohvatanjeRep="SELECT * FROM film f INNER JOIN price p ON f.idFilm=p.idFilm WHERE p.idFilm=$id";
            $idPrice = $konekcija->query($queryDohvatanjeRep)->fetch()->idPrice; 
            $queryUpisRep = "INSERT INTO repertoire(screeningDate,idFilm,idPrice) VALUES('$g-$m-$d',$id,$idPrice)";
            header("Location: ../../adminRep.php");
        
        try{
            $execUpisRep = $konekcija->query($queryUpisRep);       
        }
        catch(PDOException $ex){
            http_response_code(500);
            echo("Connection error: " .$ex->getMessage());
            exit();
        }
        }else{
            http_response_code(400);
            $porukaZaFront = implode("<br>", $greske);
            
            echo (json_encode($porukaZaFront));
        }
    }else{
        http_response_code(404);

    }
?>