<?php
    // unset($_SESSION['user']);
    $ispis = "<div id='login'><div class='wrapper'><ul>";
    if(!isset($_SESSION['user'])) {
        $ispis .= "<li><a href='loginRegister.php' id='btnLogin' class='btnLogin'>Log in</a></li><li><a href='loginRegister.php' id='btnRegister' class='btnLogin'>Register</a></li>";
    } else {
        $user = $_SESSION['user'];
        if($user->roleType == 'admin'){      
                $ispis .= "<li><a href='index.php' class='mr-3' id='btnAdmin'>Return to site</a></li>";
                $ispis .= "<li><a href='adminMovies.php' id='btnAdmin'>Admin panel</a></li>";
        }

        $korisnik = $user->username;
        $ispis .= "<li><label class='ml-3 mt-2 loginTekst'>Welcome $korisnik</label></li><li><a href='logout.php' id='btnLogout' class='font-weight-bold ml-3'>Log out</a></li>";
    }
    $ispis .= "</ul></div></div>";
    echo($ispis);
?>