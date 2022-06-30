<?php
        include("../konekcija/konekcija.php");
        global $konekcija;
        if(isset($_POST["btnAddMovie"])){
            $greske = [];
            
            $filmName = $_POST["filmName"];
            $summary = $_POST["summary"];
            $d = $_POST["dan"];
            $m = $_POST["mesec"];
            $g = $_POST["god"];
            $duration = $_POST["duration"];
            settype($_POST['price'],"integer");
            $cena=$_POST['price'];

            $regExFilmName = "/^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-ZĐŠČĆŽ][a-zđšćčž]{2,})*$/";

    
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

                $queryUpis="INSERT INTO film(filmName,summary,pictureSrc,pictureAlt,duration,premiere) VALUES('$filmName','$summary','$naziv','$name',$duration,'$g-$m-$d')";
            }

            try{
                $execUpis=$konekcija->query($queryUpis);
                $datumUnosa=date("Y-m-d");
                $id= $konekcija->lastInsertId();

                $dodajCenu="INSERT INTO price(price,dateFrom,idFilm) VALUES ($cena,$datumUnosa,$id)";
                $priprema2=$konekcija->prepare($dodajCenu);
                try{
                    $priprema2->execute();
                    $poruka="Successfully!";
                    $kod=201;
                }
                catch(PDOException $ex){
                    var_dump($ex);
                    $poruka="Server error";
                    $kod=500;
                }
            }
            catch(PDOException $ex){
                $poruka="Server error";
                $kod=500;
            }
        }
        else{
            http_response_code(400);
            $greske="greska";
        }

        }
        else{
            http_response_code(404);
            header("Location: ../../dodavanjeMovies.php"); 
        }
        http_response_code(200);
        header("Location: ../../adminMovies.php");   
?> 