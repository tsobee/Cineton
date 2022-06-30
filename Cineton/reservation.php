<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;

    if(!isset($_SESSION["user"])){
        $_SESSION["greska"]="You must be logged in";
        header("Location: loginRegister.php");
    }
    $film="SELECT * FROM repertoire r INNER JOIN film f ON r.idFilm=f.idFilm INNER JOIN price p ON f.idFilm=p.idFilm WHERE r.idRepertoire=".$_GET['id'];
    $execFilm=$konekcija->query($film)->fetch();
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
    <h2 class="naslov">Book you tickets with one click:</h2>
    <div id="drziSve" class="w-100 d-inline-flex p-5 d-flex justify-content-center">
        <div class="p-4">
            <img src="assets/img/<?=$execFilm->pictureSrc?>" alt="<?=$execFilm->pictureAlt?>" />
        </div>
        <div class="p-4">
            <h2><?=$execFilm->filmName?></h2>
            <p class="font-weight-bold">Duration: <span id="trajanje"><?=$execFilm->duration?> min</span></p>
            <p class="font-weight-bold ">Price of one ticket: <span id="cena"><?=$execFilm->price?></span>&euro;</p>
        <form action="php/stranice/obradaRes.php" method="POST">
        <select id="brojKarata" name="brojKarata" class="p-2 font-weight-bold brd">
            <option value="0">Number of tickets</option>
            <?php
                for($i=1;$i<=5;$i++):
            ?>
            <option value="<?=$i?>"><?=$i?></option>
            <?php
                endfor;
            ?>
        </select>
                <p class="font-weight-bold mt-5">Total: <span id="ukupno"> </span> &euro;</p>
            
                <input type="submit" value="Reserve" id="btnRezervisi" name="btnRes" class="mt-3 btn btn-dark">
                <input type="hidden" name="idRepertoire" value="<?=$execFilm->idRepertoire?>">
        </form>
        <?php
            if(isset($_SESSION["greska"])){
                echo("<p class='mt-2'>".$_SESSION["greska"]."</p>");
                unset($_SESSION["greska"]);
            }
            if(isset($_SESSION["uspesno"])){
                echo("<p class='mt-2'>".$_SESSION["uspesno"]."</p>");
                unset($_SESSION["uspesno"]);
            }
        ?>
        </div>            
    </div>
        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>
