<?php
        include("../konekcija/konekcija.php");
        global $konekcija;
        if(isset($_POST["btnUpdateMovies"])){
            $idMovie=$_POST["idMoviesUpdate"];

            $greske = [];
            
            $filmName = $_POST["filmName"];
            $summary = $_POST["summary"];
            $d = $_POST["dan"];
            $m = $_POST["mesec"];
            $g = $_POST["god"];
            $duration = $_POST["duration"];
            settype($_POST['price'],"integer");
            $cena=$_POST['price'];


            $regExFilmName = "/^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-zđšćčž]{2,})*$/";

    
            if(!preg_match($regExFilmName,$filmName)){
                array_push($greske, "Film name is incorrect");
            }
            if(empty($summary)){
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
            if((int)$duration < 90 && (int)$duration > 240){
                array_push($greske, "Incorrect");
            }

     if(count($greske) == 0 )
     {
            if(!empty($_FILES["picture"]["name"])){
                $slika=$_FILES["picture"];
                $tmpName=$slika['tmp_name'];
                $size=$slika['size'];
                $tip=$slika['type'];
                $name=$slika['name'];
                $naziv=time().$name;
                $putanja="../../assets/img/$naziv";

                if(!move_uploaded_file($tmpName,$putanja)){
                    $poruka="Error";
                    $kod=200;
                }

                //u slucaju da je slika prosledjena

                $upit="UPDATE film SET filmName=:filmName,pictureSrc=:picture,pictureAlt=:pictureAlt,summary=:summary,duration=:duration,premiere='$g-$m-$d' WHERE idFilm=:idMovie";
                $priprema=$konekcija->prepare($upit);
                $priprema->bindParam(":filmName",$filmName);
                // $priprema->bindParam("premiere","$g-$m-$d");
                $priprema->bindParam(":summary",$summary);
                $priprema->bindParam(":picture",$naziv);
                $priprema->bindParam(":pictureAlt",$name);
                $priprema->bindParam(":duration",$duration);
                $priprema->bindParam(":idMovie",$idMovie);
            }
            else{
                //update ostatak(u slucaju da slika nije prosledjena)

                $upit="UPDATE film SET filmName=:filmName,premiere='$g-$m-$d',summary=:summary,duration=:duration WHERE idFilm=:idMovie";
                $priprema=$konekcija->prepare($upit);
                $priprema->bindParam(":filmName",$filmName);
                $priprema->bindParam(":summary",$summary);
                $priprema->bindParam(":duration",$duration);
                $priprema->bindParam(":idMovie",$idMovie);
            }


            try{
                $priprema->execute();
                
                $datumUnosa=date("Y-m-d");

                var_dump($datumUnosa);
                $dodajCenu="UPDATE price SET price=$cena, dateFrom='$datumUnosa' WHERE idFilm=$idMovie";
                $exec=$konekcija->query($dodajCenu);
            }
            catch(PDOException $ex){
                var_dump($ex->getMessage());
                $poruka="Server error";
                $kod=500;
            }
        }
        else{
            http_response_code(400);
            $greske="greska";
        }

        }else{
            http_response_code(404);
            header("Location: ../../editovanjeMovies.php"); 
        }
        http_response_code(200);
        header("Location: ../../adminMovies.php");   
?> 