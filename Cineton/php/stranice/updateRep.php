 <?php
        include("../konekcija/konekcija.php");
        global $konekcija;
        if(isset($_POST["btnUpdate"])){
            $idRep=$_POST["idRepUpdate"];
    
            $greske = [];
            
            $d = $_POST["dan"];
            $m = $_POST["mesec"];
            $g = $_POST["god"];
  
            if((int)$d <= 0 && (int)$d > 31){
                array_push($greske, "Incorrect");
            }
            if((int)$m<= 0 && (int)$m > 12){
                array_push($greske, "Incorrect");
            }
            if((int)$g < 2022 && (int)$g > 2032){
                array_push($greske, "Incorrect");
            }
     
        if(count($greske) == 0 )
        {
            $queryUpdate = "UPDATE repertoire SET  screeningDate = '$g-$m-$d' WHERE idRepertoire = $idRep";   

            try{      
                $execUpdate=$konekcija->query($queryUpdate);
                header("Location: ../../adminRep.php"); 
            }
            catch(PDOException $ex){
                http_response_code(500);
                echo("Connection error: " . $ex->getMessage());
                exit();
            }     
        }
        else{
            http_response_code(400);
        }

        }else{
            http_response_code(404);
            header("Location: ../../editovanjeRep.php");   
        }
?> 