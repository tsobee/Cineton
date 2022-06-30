<?php
    if(isset($_POST["btnPosalji"])){
        include("../konekcija/konekcija.php");
        global $konekcija;

        $greske=[];

        $imePrezime = $_POST["imePrezime"];
        $email = $_POST["email"];
        $tel = $_POST["telefon"];
        $napomena = $_POST["msg"];

        $regExImePrezime = "/^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-ZĐŠČĆŽ][a-zđšćčž]{2,})$/";
        $regExMail = "/^[a-z][a-z0-9\.]{2,}@([a-z0-9]{2,}\.)+[a-z]{2,}$/";
        $regExTelefon = "/^[0-9]{3}(-?[0-9]{3,4}){2}$/";
    
    
        if(!preg_match($regExImePrezime, $imePrezime)){
            array_push($greske, "Name is incorrect");
        }
        if(!preg_match($regExMail, $email)){
            array_push($greske, "Email is incorrect");
        }
        if(!preg_match($regExTelefon, $tel)){
            array_push($greske, "Number is incorrect");
        }
    
        if(empty($napomena)){
            array_push($greske, "Message can not be empty");
        }

    if(count($greske) == 0){
        
        $samoIme = explode(" ", $imePrezime)[0];
        $samoPrezime = explode(" ", $imePrezime)[1];
        $queryIspisPodataka = "INSERT INTO message(firstName,lastName,email,number,message) VALUES('$samoIme', '$samoPrezime','$email','$tel','$napomena')";
               
         try{
             $execIspisPodataka = $konekcija->query($queryIspisPodataka);        
         }
         catch(PDOException $ex){
             http_response_code(500);
             echo("Connection error: " .$ex->getMessage());
             exit();
         }
         http_response_code(200);
         echo (json_encode("Your message has been send successfully."));
    }
    else{     
        http_response_code(400);
        echo (json_encode("Message not send. Please try again."));
    }
}
    else{
        http_response_code(404);
    }
?>