<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
    $queryFilmovi="SELECT * FROM film";
    $execFilmovi=$konekcija->query($queryFilmovi)->fetchAll();
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
        <div class="container">
        <div class="row">
           <div class="col-6 mx-auto py-5">
                <form action="php/stranice/addRep.php" method="post">
                    <div class="form-row">
                    <h2 class="naslov">Add</h2>
                     <div class="form-group col-12">
                        <label for="" class="font-weight-bold"> Film names </label>
                        <select id="film" name="film" class="form-control text-dark">
                        <option value="0" >Select</option>
                            <?php
                              foreach($execFilmovi as $ef):
                            ?>
                              <option value="<?=$ef->idFilm?>"><?=$ef->filmName?></option>
                            <?php
                              endforeach;
                            ?>
                        </select>
                            </div>
                            </div>
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
                                 <option value="<?=$i?>"><?=$i?></option>
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
                                 <option value="<?=$i?>"><?=$i?></option>
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
                                 <option value="<?=$i?>"><?=$i?></option>
                              <?php
                                 endfor;
                              ?>
                        </select>
                     </div>
                </div>
                     <input type="submit"  id="form-submit" name="btnAdd" class="btnAdd btn-dark form-control" value="Add"/>
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