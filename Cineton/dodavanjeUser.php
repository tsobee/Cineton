<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
    $queryRole="SELECT * FROM role";
    $execRole=$konekcija->query($queryRole)->fetchAll();
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
           <h2 class="naslov">Add user</h2>
        <form action="php/stranice/upisUser.php" method="post">
                <div class="row">
                <div class="col-12 my-5">
                    <fieldset>
                    <input name="name" type="text" class="form-control mb-2 text-dark" id="name" placeholder="full name" >
                    </fieldset>
                    <fieldset>
                    <input name="username" type="text" class="form-control mb-2 text-dark" id="username" placeholder="username" >
                    </fieldset>
                    <fieldset>
                    <input name="email" type="text" class="form-control mb-2 text-dark" id="email" placeholder="email">
                    </fieldset>
                    <fieldset>
                    <input name="password" type="password" class="form-control mb-2 text-dark" id="password" placeholder="password" >
                    </fieldset>
                    <fieldset>
                    <input name="confirm" type="password" class="form-control mb-4 text-dark" id="confirm" placeholder="confirm password" >
                    </fieldset>     
                    <label for="" class="font-weight-bold"> Role type </label>
                        <select id="role" name="role" class="form-control mb-5 text-dark">
                        <option value="0" >Select</option>
                            <?php
                              foreach($execRole as $er):
                            ?>
                            <option value="<?=$er->idRole?>"><?=$er->roleType?></option>
                            <?php
                              endforeach;
                            ?>
                        </select>
                    <fieldset>
                    <input type="submit"  id="form-submit" name="btnAddUser" class="btnAddUser btn-dark form-control" value="Add"/>
                    </fieldset>
                    </div>
                <span class="mx-auto" id="valid"></span>
                </div>
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