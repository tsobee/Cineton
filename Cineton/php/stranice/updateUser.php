<?php
        include("../konekcija/konekcija.php");
        global $konekcija;
        if(isset($_POST["btnUpdateUser"])){
            $idUser=$_POST["idUserUpdate"];
    
            $greske = [];
            
            $fullname = $_POST["fullName"];
            $mail = $_POST["email"];
            $username = $_POST["username"];
            $role=$_POST["role"];

    
            $regExFullName = "/^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-ZĐŠČĆŽ][a-zđšćčž]{2,})$/";
            $regExUsername = "/^[a-zA-Z]\w{4,}$/";
            $regExMail = "/^[a-z][a-z0-9\.]{2,}@([a-z0-9]{2,}\.)+[a-z]{2,}$/";
            $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";
    
            if(!preg_match($regExFullName,$fullname)){
                array_push($greske, "Fullname is incorrect");
            }
    
            if(!preg_match($regExUsername,$username)){
                array_push($greske, "Username is incorrect");
            }
    
            if(!preg_match($regExMail, $mail)){
                array_push($greske, "Email is incorrect");
            }
            if(empty($role)){
                array_push($greske, "Can not be empty");
            }

            
        if(count($greske) == 0 )
        {
            $samoIme = explode(" ", $fullname)[0];
            $samoPrezime = explode(" ", $fullname)[1];
            $queryUpdate = "UPDATE user SET firstName='$samoIme',lastName='$samoPrezime',email='$mail',username='$username',idRole=$role  WHERE idUser = $idUser";
                        
            try{
                
                $execUpdate=$konekcija->query($queryUpdate);
                header("Location: ../../adminUsers.php"); 
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
            header("Location: ../../editovanjeUsers.php"); 
    
        }
?> 