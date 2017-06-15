<?php
require 'core.inc.php';
require 'connection.php';

if (loggedin()) {
    $id = $_SESSION['user_id'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Oldala</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet"  href="fooldal.css">
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="index.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Hirdetesek </a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav" id="nav">
                        <li><a href="insert_data">Hirdetés feltöltése</a></li>
                        <li><a href="users_search">Kerses</a></li>
                        <li><a href="felhasznalo_adatai">Hirdetéseim</a></li>
                        <li><a href="uzenet_olvasas">Üzeneteim</a></li>
                        <li><a href="users_data">Adataim</a></li>
                        <button type="submit" class="logout_button" onclick="location.href ='logout.php';"  >Logout</button>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="content" class="margin_set_login"></div>
    </body>
    </html>
    <?php
} else {
    header('Location:fooldal.php');
}
?>
