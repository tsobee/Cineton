<footer id="footer">
    <?php
        include("php/konekcija/konekcija.php");
        global $konekcija;
    ?>
    <div class="wrapper">
        <div id="links">
            <ul>
                <?php
                    $queryIspisFoot="SELECT * FROM menu WHERE admin=0";
                    $execIspisFoot=$konekcija->query($queryIspisFoot)->fetchAll();
                    foreach($execIspisFoot as $eif) {
                        echo("<li><a href='$eif->href'>$eif->name</a></li>");
                    }
                ?>
            </ul>
        </div>
        <div id="social">
            <ul>
                <?php
                    $queryIspisSocial="SELECT * FROM social";
                    $execIspisSocial=$konekcija->query($queryIspisSocial)->fetchAll();
                    foreach($execIspisSocial as $eis) {
                        echo("<li><a href='$eis->link' target='_blank'><i class='$eis->icon'></i><span class='socialText'>$eis->name</span></a></li>");
                    }
                ?>
            </ul>
        </div>
    </div>
    <span id="copyright">Copyright &copy; Aleksa Strugarevic 2022</span>
</footer>
<?php
    include("scripts.php");
?>