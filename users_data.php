<?php
require 'connection/connect_to_session.php';
require 'rb.php';

R::setup('mysql:host=localhost;dbname=projekt', 'root', '');
R::debug(false);

$id = $_SESSION["user_id"];

//retriving a bean
$ob = R::load('projekt', $id);

echo '

    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/css/useres_data.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <form action="user_data_update.php" method="POST">
                <div class="adataim-doboza""
                    <p"><h1>Adataim</h1></p>
                    <div class="input-paddings">
                         <input type="hidden" id="aktualisisd" name="aktualisisd" value="' . $ob->id . '">
                         <div class="form-group">
                              <label for="usr">Felhasználónév :</label>
                                <input type="text" class="form-control" name="username" id="username" value="' . $ob->username . '"  onchange="modositva()"/>
                         </div>
                         <div class="form-group">
                              <label for="usr">Keresztnév :</label>
                                <input type="text" class="form-control" name="firstname" id="firstname"  value="' . $ob->firstname . '"  onchange="modositva()"/>
                         </div>
                         <div class="form-group">
                              <label for="usr">Becenév:</label>
                                <input type="text" class="form-control" name="surname" id="surname" value="' . $ob->surname . '"  onchange="modositva()" />
                         </div>
                        <div>
                            <button type="submit" class="btn btn-danger">Feltöltés</button>
                        </div>
                   </div>

    </form>
    <script src="upload/js/jquery.min.js"></script>
    <script src="upload/js/bootstrap.min.js"></script>
    </body>
    </html>'

?>
