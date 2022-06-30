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
        <h1 class="naslov">Repertoire</h1> 
        <?php 
            if(isset($_GET['message'])){
                echo "<p class='naslov animationRep'>".$_GET['message']."</p>";
            }
        ?>
        <div class="container">
        <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Film name</th>
                <th>Screening date</th>
                <th>Edit/Delete</th>
            </tr>
        <?php
            include("php/stranice/ispisRep.php");
            foreach($execIspisRep as $eip):
        ?>
            <tr>
                <td><?=$eip->filmName?></td>
                <td><?=$eip->screeningDate?></td>
                <td>
                    <form action="editovanjeRep.php" method="POST">
                    <input type="submit" name="btnEditRep" class="btnEditRep btn-dark form-control w-50" value="Edit"/>
                        <input type="hidden" name="idRep" value="<?= $eip->idRepertoire ?>">
                    </form>
                    <form action="php/stranice/brisanjeRep.php" method="POST" class="pt-2">
                        <input type="submit" name="btnDelRep" class="btnDelRep btn-dark form-control w-50" value="Delete"/>
                        <input type="hidden" name="idRep" value="<?= $eip->idRepertoire ?>">
                    </form>
                </td>
            </tr>     
        <?php
            endforeach;
        ?>
        </table>
        </div>
        </div>
            <form action="dodavanjeRep.php" method="POST">
                <input type="submit" id="form-submit" name="btnAddRep" class="btnAddRep btn-dark form-control w-25 m-5" value="Add new"/>
            </form>
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