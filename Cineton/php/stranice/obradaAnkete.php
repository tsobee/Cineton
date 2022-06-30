<?php
session_start();
include("../konekcija/konekcija.php");
global $konekcija;
    if(isset($_POST["dugme"])){
        $greske=[];
        if(!isset($_POST["odg"])){
            array_push($greske, "Nije nista cekirano");
        }else{
            $anketa = $_POST["odg"];
        }
        if(count($greske)==0){
            try{
                $idAnkete=1;
                if(isset($_SESSION["user"])){
                    $idUser=$_SESSION["user"]->idUser;

                    $insertAnkete="INSERT INTO answer(answer,idSurvey,idUser) VALUES($anketa,$idAnkete,$idUser)";
                    $execInsertAnkete=$konekcija->query($insertAnkete);
                echo json_encode("Uspeo si");
                http_response_code(200);
                }            
            }catch(PDOException $ex){
                echo json_encode($ex->getMessage());
                http_response_code(500);
            }
        }
    }else{
        header("Location: 404.php");
    }
?>