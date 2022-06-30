<?php
    include("../konekcija/konekcija.php");
    global $konekcija;
    if(isset($_POST["btnRegister"])){
        
        $fullName=$_POST["name"];
        $username=$_POST["username"];
        $mail=$_POST["email"];
        $password=$_POST["pass"];
        $greske=[];

        $regExFullName = "/^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-ZĐŠČĆŽ][a-zđšćčž]{2,})$/";
        $regExUsername = "/^[a-zA-Z]\w{4,}$/";
        $regExMail = "/^[a-z][a-z0-9\.]{2,}@([a-z0-9]{2,}\.)+[a-z]{2,}$/";
        $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        if(!preg_match($regExFullName,$fullName)){
            array_push($greske, "Fullname is incorrect");
        }

        if(!preg_match($regExUsername,$username)){
            array_push($greske, "Username is incorrect");
        }

        if(!preg_match($regExMail, $mail)){
            array_push($greske, "Email is incorrect");
        }
        if(!preg_match($regExpPassword, $password)){
            array_push($greske, "Password is incorrect");
        }else{
            $encrypt=md5($password);
        }

        if(count($greske)==0){
            $first = explode(" ", $fullName)[0];
            $last = explode(" ", $fullName)[1];
            $queryCheckMail="SELECT * FROM user WHERE email LIKE '$mail'";
            $queryCheckUsername="SELECT * FROM user WHERE username LIKE '$username'";

            $getUser=$konekcija->query($queryCheckMail);
            $getUsername=$konekcija->query($queryCheckUsername);
            if($getUser->rowCount()==1){
                http_response_code(200);
                echo (json_encode("Email is already in use."));
            }else if($getUsername->rowCount()==1){
                http_response_code(200);
                echo (json_encode("Username is already in use."));
            }else
            {
                $queryUpisRegister = "INSERT INTO user(firstName,lastName,email,username,password,idRole) VALUES('$first', '$last','$mail','$username','$encrypt',2)";
                try{
    
                    $execUpisRegister=$konekcija->query($queryUpisRegister);
                    http_response_code(200);
                    echo (json_encode("Successfully."));
                }
                catch(PDOException $ex){
                    http_response_code(500);
                    echo("Connection error: " .$ex->getMessage());
                }
            }    
    }else{
        http_response_code(404);
        echo json_encode("Not successfully");
    }
}
?>