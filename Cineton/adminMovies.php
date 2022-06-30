<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cineton </title>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <?php
            include("php/stranice/head.php");
        ?>
    </head>
    <body>
        <?php
            if(isset($_SESSION["user"]) && $_SESSION["user"]->idRole==1){
            include("php/stranice/admin-header.php");
        ?>
        <h1 class="naslov">Movies</h1> 
        <?php 
            if(isset($_GET['message'])){
                echo "<p class='naslov animationMovies'>".$_GET['message']."</p>";
            }
        ?>
        <div class="container">
        <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Film name</th>
                <th>Summary</th>
                <th>PictureSrc</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Premiere</th>
                <th>Edit/Delete</th>
            </tr>
        <?php
            include("php/stranice/ispisMovies.php");
            foreach($execIspisMovies as $eim):
        ?>
            <tr>
                <td><?=$eim->filmName?></td>
                <td><?=strlen($eim->summary) > 30 ? substr($eim->summary,0, 30) . "..." : $eim->summary?></td>
                <td><?=$eim->pictureSrc?></td>
                <td><?=$eim->price?></td>
                <td><?=$eim->duration?></td>
                <td><?=$eim->premiere?></td>
                <td>
                    <form action="editovanjeMovies.php" method="POST">
                    <input type="submit" name="btnEditMovies" class="btnEditMovies btn-dark form-control w-50" value="Edit"/>
                        <input type="hidden" name="idMovies" value="<?= $eim->idFilm ?>">
                    </form>
                    <form action="php/stranice/brisanjeMovies.php" method="POST" class="pt-2">
                        <input type="submit" name="btnDelMovies" class="btnDelMovies btn-dark form-control w-50" value="Delete"/>
                        <input type="hidden" name="idMovies" value="<?= $eim->idFilm ?>">
                    </form>
                </td>
            </tr>     
        <?php
            endforeach;
        ?>
        </table>
        </div>
        </div>
            <form action="dodavanjeMovies.php" method="POST">
                <input type="submit" id="form-submit" name="btnAddMovies" class="btnAddMovies btn-dark form-control w-25 m-5" value="Add new"/>
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