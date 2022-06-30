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

        <div class="container">
        <div class="row">
           <div class="col-6 mx-auto py-5">
                <form action="php/stranice/addMovies.php" enctype="multipart/form-data" method="post">                  
                <div class="form-row">
                    <h2 class="naslov">Movies</h2>
                    <div class="form-group col-12">
                        <label for="" class="font-weight-bold"> Film name</label>
                        <input type = "text" id="filmName" name="filmName" class="form-control text-dark" placeholder="Film name"/>
                    </div>
                    <div class="form-group col-12">
                    <label for="" class="font-weight-bold"> Picture </label>
                    <input type="file" id="picture" name="picture"/>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Summary</label>
                        <textarea id = "summary" name="summary" cols="70" rows="7" class="form-control text-dark" placeholder="Summary"></textarea>
                     </div>                
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold"> Duration </label>
                        <select id="duration" name="duration" class="form-control text-dark">
                            <option value="0">Select</option>
                              <?php
                                for($i=90; $i<=240; $i++):
                              ?>
                                 <option value="<?=$i?>"><?=$i?></option>
                              <?php
                                 endfor;
                              ?>
                        </select>
                        </div>
                        <label for="price" class="font-weight-bold"> Price </label>
                        <input type="text" class="form-control text-dark" name="price" placeholder="Price"/>

                        <div class="form-row">
                         <div class="form-group col-4">
                        <label for="" class="font-weight-bold">Premiere day</label>
                        <select id="dan" name="dan" class="form-control text-dark">
                            <option value="0">Select</option>
                              <?php
                                for($i=1; $i<=31; $i++):
                              ?>
                                 <option value="<?=$i?>"><?=$i?></option>
                              <?php
                                 endfor;
                              ?>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="" class="font-weight-bold">Premiere month</label>
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
                        <label for="" class="font-weight-bold">Premiere year</label>
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
                <input type="submit"  id="form-submit" name="btnAddMovie" class="btnAddMovie btn-dark form-control" value="Add"/>  
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