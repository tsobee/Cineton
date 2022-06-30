<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cineton </title>
        <?php
            include("php/stranice/head.php");
        ?>
    </head>
    <body>
        <?php
            include("php/stranice/header.php");
        ?>
        <div class="container my-5">
            <div class="row">
        <div class="col-md-6 p-5">
        <h2 class="naslov">Register</h2>
        <form id="registerForm" action="#" method="post">
                <div class="row">
                <div class="col-12 my-5">
                    <fieldset>
                    <input name="name" type="text" class="form-control bg-warning mb-2 text-dark" id="name" placeholder="full name" >
                    </fieldset>
                    <fieldset>
                    <input name="username" type="text" class="form-control bg-warning mb-2 text-dark" id="username" placeholder="username" >
                    </fieldset>
                    <fieldset>
                    <input name="email" type="text" class="form-control bg-warning mb-2 text-dark" id="email" placeholder="email">
                    </fieldset>
                    <fieldset>
                    <input name="password" type="password" class="form-control bg-warning mb-2 text-dark" id="password" placeholder="password" >
                    </fieldset>
                    <fieldset>
                    <input name="confirm" type="password" class="form-control bg-warning mb-4 text-dark" id="confirm" placeholder="confirm password" >
                    </fieldset>
                    <fieldset>
                    <button type="button" id="registerBtn" class="form-control text-warning btn-dark">Register</button>
                    </fieldset>
                    </div>
                <span class="mx-auto" id="valid"></span>
                </div>
            </form>
        </div>
        <div class="col-md-6 p-5">
            <h2 class="naslov">Login</h2>
            <form id="loginForm" action="#" method="post">
                <div class="row">
                <div class="col-12 my-5"> 
                    <fieldset>
                    <input name="email" type="text" class="form-control bg-warning mb-2 text-dark" id="emailLogin" placeholder="email">
                    </fieldset>
                    <fieldset>
                    <input name="password" type="password" class="form-control bg-warning mb-4 text-dark" id="passwordLogin" placeholder="password" >
                    </fieldset>
                    <fieldset>
                    <button type="button" id="loginBtn" class="form-control text-warning btn-dark">Log in</button>
                    </fieldset>
                    </div>
                <span class="mx-auto" id="validLogin"></span>
                <?php
                    if(isset($_SESSION["greska"])){
                        echo("<p>".$_SESSION["greska"]."</p>");
                        unset($_SESSION["greska"]);
                    }
                ?>
                </div>
            </form>
        </div>
        </div>
        </div>


        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>