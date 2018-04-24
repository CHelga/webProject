<?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';

if (!loggedin()) {?>
    <!DOCTYPE>
    <html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="style/css/kereses.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <title>Lakáskereső</title>


    </head>
    <body id="main_page_margine">
    <div class="container">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Connect
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="loginform.php">Login</a></li>
                <li class="divider"></li>
                <li><a href="register.php">Register</a></li>

            </ul>
        </div>
    </div>
    <div class="keres_form">
        <form id="myForm" action="search_if_notLoggedIn.php" method="POST">
            <div class="container-fluid full_search">
                <div class="row top_row">
                    <div class="col-sm-4">
                        <select id="varos" class="varos_keres" name="varos">
                            <option value="--">Varos</option>
                            <option value="Kolozsvar">Kolozsvar</option>
                            <option value="Varad">Varad</option>
                            <option value="Braso">Braso</option>
                            <option value="Hunyad">Hunyad</option>
                        </select></div>
                    <div class="col-sm-4">
                        <input type="text" id="max" name="max" class="form-control" placeholder="Terulet" >
                    </div>
                    <div class="col-sm-4">
                        <select id="penz" class="penz_keres" name="penz">
                            <option value="--"> Penzerme</option>
                            <option value="RON">RON</option>
                            <option value="EURO">EURO</option>
                            <option value="FORINT">FORINT</option>
                        </select></div>
                </div>
                <div class="row middle_row">
                    <div class="col-sm-4">
                        <input type="text" id="maxar" name="maxar" class="form-control" placeholder="Maximalis ára">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" id="maxszobaszam" name="maxszobaszam" class="form-control"
                               placeholder=" Maximum szobák száma ">
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button class="btn btn-default dropdown-toggle keres_button" type="submit">Keresés
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div>
        <?php include 'posts.php';?>
    </div>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>

    <?php
} else {
	$admin_e = $_SESSION['admin'];
	if ($admin_e != 0) {
		header('Location:admin.php');
		exit();
	} else {
		header('Location:index.php');
		exit();
	}
}
?>