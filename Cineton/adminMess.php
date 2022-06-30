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
            if(isset($_SESSION["user"]) && $_SESSION["user"]->idRole==1){
            include("php/stranice/admin-header.php");
        ?>
        <h1 class="naslov">Messages</h1>
        <?php
            include("php/stranice/ispisMess.php");
            foreach($execIspisPoruka as $eip):
        ?>
        <div id="svePoruke" class="p-5">
        <p class="font-weight-bold">Full name: <span class="font-weight-light"><?=$eip->firstName?> <?=$eip->lastName?></span></p>
        <p class="font-weight-bold">E-mail: <span class="font-weight-light"><?=$eip->email?></span></p>
        <p class="font-weight-bold">Phone: <span class="font-weight-light"><?=$eip->number?></span></p>
        <p class="font-weight-bold">Message: <span class="font-weight-light"><?=$eip->message?></span></p>
        <p class="font-weight-bold">Date: <span class="font-weight-light"><?=$eip->date?></span></p>
        <form action="php/stranice/brisanjeMess.php" method="POST">
            <input type="submit" id="form-submit" name="btnDeleteMsg" class="btnDeleteMsg btn-dark form-control w-25" value="Delete"/>
            <input type="hidden" name="idPoruke" value="<?= $eip->idMessage?>">
        </form>
        </div>
        <?php
        endforeach;
        ?>
        <?php
            }else{
                header("Location: 404.php");
            }
        ?>
        <?php
            include("php/stranice/scripts.php");
        ?>
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>