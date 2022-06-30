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
        <h1 class="naslov">Users</h1> 
        <?php 
            if(isset($_GET['message'])){
                echo "<p class='naslov animation'>".$_GET['message']."</p>";
            }
        ?>
        <div class="container">
        <div class="table-responsive">
        <table class="table">   
            <tr>
                <th>User</th>
                <th>E-mail</th>
                <th>Username</th>
                <th>Role</th>
                <th>Edit/Delete</th>
            </tr>
        
        <?php
            include("php/stranice/ispisUsers.php");
            foreach($execIspisUsers as $eiu):
        ?>       
            <tr>
                <td><?=$eiu->firstName?> <?=$eiu->lastName?></td>
                <td><?=$eiu->email?></td>
                <td><?=$eiu->username?></td>
                <td><?=$eiu->roleType?></td>
                <td>
                    <form action="editovanjeUsers.php" method="POST">
                    <input type="submit" name="btnEditUsers" class="btnEditUsers btn-dark form-control w-50" value="Edit"/>
                        <input type="hidden" name="idUser" value="<?= $eiu->idUser ?>">
                    </form>
                    <form action="php/stranice/brisanjeUsers.php" method="POST" class="pt-2">
                        <input type="submit" name="btnDelUsers" class="btnDelUsers btn-dark form-control w-50" value="Delete"/>
                        <input type="hidden" name="idUser" value="<?= $eiu->idUser ?>">
                    </form>
                </td>
            </tr>           
        <?php
            endforeach;
        ?>
        </table>
        </div>
        </div>
            <form action="dodavanjeUser.php" method="POST">
                <input type="submit" id="form-submit" name="btnAddUsers" class="btnAddUsers btn-dark form-control w-25 m-5" value="Add new"/>
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