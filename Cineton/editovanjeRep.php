<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
    if(isset($_POST["btnEditRep"])){
        $idRep=$_POST["idRep"];

        $queryDohvatanjeRep="SELECT * FROM repertoire r INNER JOIN film f ON r.idFilm=f.idFilm WHERE r.idRepertoire=$idRep";
        $execDohvatanjeRep=$konekcija->query($queryDohvatanjeRep)->fetch();
        $queryFilmovi="SELECT * FROM film";
        $execFilmovi=$konekcija->query($queryFilmovi)->fetchAll();
    }
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
        <div class="container">
        <div class="row">
           <div class="col-6 mx-auto py-5">
                <form action="php/stranice/updateRep.php" method="post">
                    <div class="form-row">
                        <h2 class="naslov">Screening date</h2>
                    <div class="form-row">
                    <div class="form-group col-4">
                        <label for="" class="font-weight-bold"> Day</label>
                        <select id="dan" name="dan" class="form-control text-dark">
                            <option value="0">Select</option>
                              <?php
                                $deloviDatuma=explode("-",$execDohvatanjeRep->screeningDate);
                                $dan=(int)$deloviDatuma[2];
                                $mesec=(int)$deloviDatuma[1];
                                $godina=(int)$deloviDatuma[0];
                                for($i=1; $i<=31; $i++):
                              ?>
                                 <option <?= $dan==$i ? 'selected' : '' ?> value="<?=$i?>"><?=$i?></option>
                              <?php
                                 endfor;
                              ?>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="" class="font-weight-bold"> Month</label>
                        <select id="mesec" name="mesec" class="form-control text-dark">
                           <option value="0">Select</option>
                           <?php
                                 for($i=1; $i<=12; $i++):
                              ?>
                                 <option <?= $mesec==$i ? 'selected' : '' ?> value="<?=$i?>"><?=$i?></option>
                              <?php
                                 endfor;
                              ?>
                        </select>
                     </div>
                     <div class="form-group col-4">
                        <label for="" class="font-weight-bold"> Year</label>
                        <select id="god" name="god" class="form-control text-dark">
                           <option value="0">Select</option>
                           <?php
                                 for($i=2022; $i<=2032; $i++):
                              ?>
                                 <option <?= $godina==$i ? 'selected' : '' ?> value="<?=$i?>"><?=$i?></option>
                              <?php
                                 endfor;
                              ?>
                        </select>
                     </div>
                </div>
                     <input type="submit"  id="form-submit" name="btnUpdate" class="btnUpdate btn-dark form-control" value="Update"/>
                     <input type="hidden" name="idRepUpdate" value="<?= $execDohvatanjeRep->idRepertoire?>">             
                </form>
           </div>
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