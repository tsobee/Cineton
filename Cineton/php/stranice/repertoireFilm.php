<?php
include("php/konekcija/konekcija.php");
global $konekcija;

$repertoar="";
    $code=200;
    $limit=5;
    $page=1;
    $offset=0;
    $brojstr=0;

    if(isset($_GET['str'])){
        $page=$_GET['str'];
    }

    $queryRepertoire="SELECT * FROM repertoire r INNER JOIN price p on r.idPrice=p.idPrice INNER JOIN film f ON p.idFilm=f.idFilm WHERE r.screeningDate>=CURRENT_DATE ";	

    if(isset($_GET['pretraga'])){
        $search="'%".$_GET['pretraga']."%'";
        $queryRepertoire.="AND f.filmName LIKE" .$search." ";
    }

    $queryRepertoire.="ORDER BY r.screeningDate";
    try{
        $exec=$konekcija->query($queryRepertoire);
        if($exec->rowCount()!=0){
            $ukupno=$exec->rowCount();       
            $brojstr=ceil($ukupno/$limit);
            $upitZaPrikaz="SELECT * FROM repertoire r INNER JOIN price p on r.idPrice=p.idPrice INNER JOIN film f ON p.idFilm=f.idFilm WHERE r.screeningDate>=CURRENT_DATE ";
            if(isset($_GET['pretraga'])){
                $search="'%".$_GET['pretraga']."%'";
                $upitZaPrikaz.="AND f.filmName LIKE" .$search." ";
            }

            $upitZaPrikaz.=" ORDER BY r.screeningDate";

            if(isset($_GET['str'])){
                $page=$_GET['str']-1;
                $offset=$page*$limit;
                if($page+1>$brojstr){
                    $greska="Nema podudaranja za odabrane kriterijume";
                }
            }
            $upitZaPrikaz.=" LIMIT $limit OFFSET $offset";

            try{
                $rep=$konekcija->query($upitZaPrikaz);
                $repertoar=$rep->fetchAll();
            }
            catch(PDOException $ex){
                $greska=("Server error");
            }
        }
        else{
            $greska="The requested movies are currently not in the repertoire";
        }
    }
    catch(PDOException $ex){
        $greska=("Server error");
    }

?>