<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
    if(isset($_POST["btnEditUsers"])){
        $idUser=$_POST["idUser"];

        $queryDohvatanjeUser="SELECT * FROM user u INNER JOIN role r ON u.idRole=r.idRole WHERE idUser=$idUser";
        $execDohvatanjeUser=$konekcija->query($queryDohvatanjeUser)->fetch();
        $queryDohvatanjeRole="SELECT * FROM role";
        $execDohvatanjeRole=$konekcija->query($queryDohvatanjeRole)->fetchAll();
    }
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

                <form action="php/stranice/updateUser.php" method="post">
                    
                <div class="form-row">
                    <h2 class="naslov">User</h2>
                    <div class="form-group col-12">
                        <label for="" class="font-weight-bold"> Full name</label>
                        <input type = "text" id="fullName" name="fullName" class="form-control text-dark" value="<?=$execDohvatanjeUser->firstName?> <?=$execDohvatanjeUser->lastName ?>"/>
                    </div>
                    <div class="form-group col-12">
                        <label for="" class="font-weight-bold"> E-mail</label>
                        <input type="text" id="email" name="email" class="form-control text-dark" value="<?=$execDohvatanjeUser->email?>"/>
                    </div>
                    <div class="form-group col-12">
                        <label for="" class="font-weight-bold"> Username</label>
                        <input type="text" id="username" name="username" class="form-control text-dark" value="<?=$execDohvatanjeUser->username?>"/>
                    </div>                   
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold"> Role </label>
                        <select id="role" name="role" class="form-control text-dark">
                            <?php
                                foreach($execDohvatanjeRole as $edr):
                            ?>
                            <option <?= $execDohvatanjeUser->idRole == $edr->idRole ? 'selected' : '' ?> value="<?=$edr->idRole?>"> <?=$edr->roleType?> </option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                    </div> 
                    <input type="submit"  id="form-submit" name="btnUpdateUser" class="btnUpdateUser btn-dark form-control" value="Update"/>
                    <input type="hidden" name="idUserUpdate" value="<?= $execDohvatanjeUser->idUser?>">  
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