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
        <h1 class="naslov">Reservation</h1>
        <?php 
            if(isset($_GET['message'])){
                echo "<p class='naslov animationRes'>".$_GET['message']."</p>";
            }
        ?>
        <div class="container">
        <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Customer</th>
                <th>Film</th>
                <th>Date</th>
                <th>Tickets</th>
                <th>Cancle</th>
            </tr>
        <?php
            include("php/stranice/ispisRes.php");
            foreach($execIspisRes as $eir):
        ?>
            <tr>
                <td><?=$eir->firstName?> <?=$eir->lastName?></td>
                <td><?=$eir->filmName?></td>
                <td><?=$eir->screeningDate?></td>
                <td><?=$eir->ticketsNumber?></td>
                <td>
                    <form action="php/stranice/brisanjeRes.php" method="POST">
                        <input type="submit" id="form-submit" name="btnDelRes" class="btnDelRes btn-dark form-control w-100" value="Cancle"/>
                        <input type="hidden" name="idRes" value="<?= $eir->idReservation ?>">
                    </form>
                </td>
            </tr>
        <?php
            endforeach;
        ?>
        </table>
        </div>
        </div>
        <?php
            include("php/stranice/scripts.php");
        ?>
        <?php
            }else{
                header("Location: 404.php");
            }
        ?>
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>