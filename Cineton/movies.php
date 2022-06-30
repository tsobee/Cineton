<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cineton </title>
        <meta name="keywords" content="movies,premiere,duration,details"/>
        <meta name="description" content="On this page all movies are displayed"/>
        <?php
            include("php/stranice/head.php");
        ?>
    </head>
    <body>
        <?php
            include("php/stranice/header.php");
        ?>


        <div class="naslov">
            <h2 class=" text-center ">Movies</h2>
        </div>
        <div  id="moviesId" class="p-5 moviesAll">
        </div>


        
        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>