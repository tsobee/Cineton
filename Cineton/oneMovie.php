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
        <?php
            include("php/stranice/oneMovie.php");
        ?>
        <div id="jednaPredstava">
                <div id="filmovi" class="jedan">
                    <div id="filmTekst">
                        <h1><?=$film->filmName?></h1>
                        <p><?=$film->summary?></p>
                        <p>Duration: <?=$film->duration?> min</p>
                        <p>Price: <?=$film->price?> &euro;</p>
                        <p>Premiere: <?=explode("-",$film->premiere)[2].".".explode("-",$film->premiere)[1].".".explode("-",$film->premiere)[0]."."?></p>
                    </div>
                    <div>
                        <img src="assets/img/<?=$film->pictureSrc?>" alt="<?=$film->pictureAlt?>" class="oneMpic">
                    </div>
                </div>
        </div>
        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>