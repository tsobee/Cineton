<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cineton </title>
        <meta name="keywords" content="repertoire,screening,date,movie"/>
        <meta name="description" content="On this page all repertoires are displayed with screening date"/>
        <?php
            include("php/stranice/head.php");
        ?>
    </head>
    <body>
        <?php
            include("php/stranice/header.php");        
        ?>
        <?php
            include("php/stranice/repertoireFilm.php");
        ?>
<main>
    <div class="naslov">
        <h1 class="p-4">Repertoire</h1>
    </div>
    <div id="search">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
            <input type="text" name="pretraga" value="<?php
                if(isset($_GET['pretraga'])){
                    echo $_GET['pretraga'];
                }
                else{
                    echo "";
                }
            ?>" placeholder="Search">
            <input type="hidden" name="str" value="1">
        </form>
    </div>
    <?php
        if(isset($greska)):
    ?>
    <div class="naslov hgh">
        <h2><?=$greska?></h2>
    </div>
    <?php   
        else:
    ?>
        <div id="repertoar" class="my-5">
    <?php
        foreach($repertoar as $r):
    ?>
        <div class="repertoar">
            <span class="datum"><?=explode("-",$r->screeningDate)[2].".".explode("-",$r->screeningDate)[1].".".explode("-",$r->screeningDate)[0]."."?></span>
            <a href="oneMovie.php?id=<?=$r->idFilm?>"><p class='rezText'><?=$r->filmName?></p></a>
            <a href="reservation.php?id=<?=$r->idRepertoire?>" class="rezervacije" data-id="<?=$r->idRepertoire?>">Reserve</a>

        </div>
    <?php 
        endforeach;  
    ?>
        </div>
    <?php
        endif;       
    ?>
    <?php
        if($repertoar != ""):
    ?>
        <div id="stranicenje">
        <?php
            $trenutna=(isset($_GET['str'])? $_GET['str'] : 1);
            $prethodna=$trenutna-1;
            $sledeca=$trenutna+1;
            $linkPrethodna=$_SERVER['PHP_SELF']."?";
            if($trenutna!=1):
                if(isset($_GET['pretraga'])){
                    $linkPrethodna.="pretraga=".$_GET['pretraga'];  
                }
                if(isset($_GET['str'])){
                    $linkPrethodna.="&str=".$prethodna;
                }          
        ?>
            <a href="<?=$linkPrethodna?>">Previous</a>       
    <?php
        endif;
        
        for($i=1;$i<=$brojstr;$i++):
    ?>
        <a href="<?php       
        $link=$_SERVER['PHP_SELF']."?str=".$i?>
        <?php
            if(isset($_GET['pretraga'])){
                $link.="&pretraga=".$_GET['pretraga'];
            }
            echo $link;
        ?>   
        "
        <?php
            if($trenutna==$i):
        ?>
            class="aktivanLink"
        <?php
            endif;
        ?>
        ><?=$i?></a>
    <?php
        endfor;
        if($trenutna!=$brojstr):
            $linkSledeca=$_SERVER['PHP_SELF']."?";
            if(!isset($_GET['str'])){
                $linkSledeca.="str="."2";
            }
            if(isset($_GET['str'])){
                $linkSledeca.="str=".$sledeca;
            }
            if(isset($_GET['pretraga'])){
                $linkSledeca.="&pretraga=".$_GET['pretraga'];
            }
    ?>
        <a href="<?=$linkSledeca?>">Next</a>
    <?php
        endif;
    ?>
    </div>
    <?php
        endif;
    ?>
</main>      
        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>
