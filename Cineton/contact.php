<?php
    session_start();
    include("php/konekcija/konekcija.php");
    global $konekcija;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cineton </title>
        <meta name="keywords" content="contact,survay,message,evaluation"/>
        <meta name="description" content="On that page of site customer can contact us without loging in, also user can fill in out survay if he has account"/>
        <?php
            include("php/stranice/head.php");
        ?>
    </head>
    <body>
        <?php
            include("php/stranice/header.php");       
        ?>
        <?php
              if(isset($_SESSION["user"]))
              {
                $korisnik=$_SESSION["user"];
                $vecGlasao="SELECT * FROM answer WHERE idUser=$korisnik->idUser";
                $execVecGlasao=$konekcija->query($vecGlasao)->fetch();
                if(!$execVecGlasao){
                    ?>
                      <div id="drzacAnkete">
        <div class="naslov">
            <h1 class="py-3 text-center ">Survey</h1>
        </div>
        <?php
                $queryAnketa="SELECT * FROM survey";
                $execAnketa=$konekcija->query($queryAnketa)->fetchAll();
                foreach($execAnketa as $ea):
        ?>
                <p class="anketa"><?=$ea->question?></p>
        <?php
        endforeach;
        ?>
        <p class="anketa">Answer:</p>
        <form action="#" method="">
        <div id="odg">
            <?php
                for($i=1;$i<=5;$i++):
            ?> 
                <div class="form-check odg">
                <input type='radio' name='rdb' class='rdb form-check-input' value='<?=$i?>'/><?=$i?>
                </div>
            <?php
                endfor;
            ?>
            <input type="button" id="btnAnketa" name="btnAnketa" value="Submit"/>
            </div>
            </form>
            <?php
                }             
              }
            ?>
    </div>
    <p id="poruka" class="text-center"></p>
    <section class="page-heading contactUs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 naslov">
                    <h2 class="naslov">Contact Us</h2>
                    <p>If you are interested in some of our movies contact us!</p>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-us mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                <div class="section-heading">
                    <h2 class="msg">Message</h2>
                </div>
                <form id="contact" action="obradaForme.php" method="post">
                    <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                        <input name="name" type="text" class="formcontrol" id="name" placeholder="Your name..." >
                        </fieldset>
                        <fieldset>
                        <input name="email" type="text" class="formcontrol" id="email" placeholder="Your email...">
                        </fieldset>
                        <fieldset>
                        <input name="phone" type="text" class="formcontrol" id="phone" placeholder="Your phone..." >
                        </fieldset>
                        </div>
                        <div class="col-md-6">
                        <fieldset>
                        <textarea name="msg" rows="6" class="formcontrol" id="msg" placeholder="Your message..." ></textarea>
                        </fieldset>
                        <fieldset>
                        <button type="button" id="form-submit"
                        class="btnAjax">Send Message</button>
                        </fieldset>
                    </div>
                    <span class="mx-auto" id="valid"></span>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>      
        <?php
            include("php/stranice/footer.php");
        ?> 
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>