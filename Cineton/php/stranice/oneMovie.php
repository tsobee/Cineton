<?php 
        global $konekcija;

        if(isset($_GET["id"])){
            $id=$_GET["id"];
            $film="";
            $code=200;
            $queryIspisFilma="SELECT * FROM film f INNER JOIN price p ON f.idFilm=p.idFilm WHERE f.idFilm=$id";

            try{
                $ispisFilma=$konekcija->query($queryIspisFilma);
                if($ispisFilma->rowCount()==1){
                    $film=$ispisFilma->fetch();
                }else{
                    //header("Location: 404.php");
                }
            }
            catch(PDOException $e){
                $film="Server error";
                $code=500;
            }
        }else{
            //header("Location: 404.php");
        } 
?>