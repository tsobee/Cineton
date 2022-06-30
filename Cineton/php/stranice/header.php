<div id="header">
    <?php
        include("php/konekcija/konekcija.php");
        global $konekcija;
        include("php/stranice/login.php");
    ?>
    <div id="logoAndNav">
        <div class="wrapper">
            <div id="logo">
                <a href="index.php">
                    <img src="assets/img/logo.png" alt="logo" width="130" height="130">
                </a>
            </div>
            <div id="navigation">
                <div id="nav">
                    <ul>
                        <?php
                            $queryIspisNav="SELECT * FROM menu WHERE admin=0";
                            $execIspisNav=$konekcija->query($queryIspisNav)->fetchAll();
                            foreach($execIspisNav as $ein) {
                                echo("<li><a href='$ein->href'>$ein->name</a></li>");
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="hamburger">
                    <a href="#">
                        <i class="fas fa-bars font-large"></i>
                    </a>
            </div>
            <div id="sideNav">
                    <div class="cover">
                        <div id="sideNavContent">
                            <ul>
                                <?php
                                    $queryIspisNav="SELECT * FROM menu WHERE admin=0";
                                    $execIspisNav=$konekcija->query($queryIspisNav)->fetchAll();
                                    foreach($execIspisNav as $ein) {
                                        echo("<li><a href='$ein->href'>$ein->name</a></li>");
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>