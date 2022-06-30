<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cineton </title>
        <meta name="keywords" content="about,pricelist,next,social"/>
        <meta name="description" content="This page is the first page, also that is info page on that site."/>
        <?php
            include("php/stranice/head.php");
        ?>
    </head>
    <body>
        <?php
            include("php/stranice/header.php");
        ?>
        <div id="baner">
        <div class="bg1">
        </div>
        <div class="wrapper">

        <div id="tekst1">
            <p>Welcome to CINETON</p>
        </div>
        </div>
        </div>
        

        <div id="aboutUs">
        <div id="txt">
            <div class="txt">
                <img src="assets/img/aboutus.jpg" alt="About us" class="auPic">
            </div>
            <div class="txt">
                <h2>About us</h2>
                <p>Cineton was founded in 1998. The first cinema was opened in Belgrade, Serbia, since then our cinemas expanded over the whole Balkan region.<br/><br/> Our theatres offer you experience with the latest technology.You can watch movies in digital 3D, MX4D and the latest IMAX technology. Our largest halls offer 4K projection resolution and HFR technology. 
                    In the hall of the cinema there is a cafe and the lounge area. <br/><br/>Working hours: <br/><br/>The working hours of the box office are from:<br/>15:00 - 22:00 on week days<br/>12:00 - 22:00 Saturday, Sunday</p>
            </div>
        </div>
    </div>
    <div id="naRepertoaru">

    </div>
    <div id="cenovnik">
        <h2>Pricelist</h2>
        <table></table>
    </div>
        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>