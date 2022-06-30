<?php
    session_start();
    include("../konekcija/konekcija.php");
    global $konekcija;
    if(isset($_POST["btnLogin"])){
        
        $mail=$_POST["email"];
        $password=$_POST["pass"];
        $password=md5($password);
        
        $daLiPostojiUser="SELECT * FROM user u INNER JOIN role r ON u.idRole=r.idRole WHERE email LIKE '$mail'";
        $execPostojiUser=$konekcija->query($daLiPostojiUser);
        if($execPostojiUser->rowCount()==1){
            $daLiPostojiUserPassword="SELECT * FROM user u INNER JOIN role r ON u.idRole=r.idRole WHERE email LIKE '$mail' AND password LIKE '$password'";
            $execPostojanje=$konekcija->query($daLiPostojiUserPassword);
            if($execPostojanje->rowCount()==1){
                $user=$execPostojanje->fetch();
                $_SESSION["user"]=$user;

                http_response_code(200);
                echo json_encode("Ok");
            }else{
                http_response_code(200);
                echo json_encode("Password is incorrect");
            }
        }else{
            http_response_code(200);
            echo json_encode("User not found");
        }        
    }else{
        http_response_code(404);
        echo json_encode("Not successfully");
    }
?>