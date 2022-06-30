<?php
session_start();
include("../konekcija/konekcija.php");
global $konekcija;

if(!isset($_SESSION["user"])){
    $_SESSION["greska"]="You must be logged in";
    header("Location: ../../loginRegister.php");
}

$userId=$_SESSION["user"]->idUser;

if(isset($_POST["btnRes"])){
    $brKarata=$_POST["brojKarata"];
    $idRepertoire=$_POST["idRepertoire"];

    if($brKarata == 0){
        $_SESSION["greska"]="You must choose number of tickets";
        header("Location: ../../reservation.php?id=$idRepertoire");
    }
    
    $upisRez="INSERT INTO reservation(idRepertoire,idUser,ticketsNumber) VALUES($idRepertoire,$userId,$brKarata)";

    try
    {
        $execUpisRez=$konekcija->query($upisRez);
        http_response_code(200);
        $_SESSION["uspesno"]="You have successfully booked your tickets";
        header("Location: ../../reservation.php?id=$idRepertoire");
    }
    catch(PDOException $ex)
    {
        http_response_code(400);
        //echo($ex->getMessage());
    }
}
else{
    http_response_code(404);
}
?>