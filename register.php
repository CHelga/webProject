<?php
require 'core.inc.php';
require 'connection.php';

$error = '';
if (!loggedin()) {
    if (
        isset($_POST['username']) &&
        isset($_POST['password']) &&
        isset($_POST['password_again']) &&
        isset($_POST['firstname']) &&
        isset($_POST['surname'])
    ) {

        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $password_again = mysqli_real_escape_string($mysqli, $_POST['password_again']);
        $password_hash = md5($password);
        $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
        $surname = mysqli_real_escape_string($mysqli, $_POST['surname']);
        $admin = 0;

        if (!empty($username) && !empty($password) && !empty($password_again) && !empty($firstname) && !empty($surname)) {
            if ($password != $password_again) {
                $error = "A passwordok nem talalnak";
            } else {
                //megvizsgaljuk ha a username letezik mar az adatbazisban
                $query = "SELECT `username` FROM `projekt` WHERE `username` = '$username' ";
                $query_run = mysqli_query($mysqli, $query);

                if (mysqli_num_rows($query_run) == 1) {
                    $error = "A felhasználónév " . $username . "már létezik.";
                } else {
                    //beszurjuk az uj felhasznalo ertekeit
                    //	$query = "INSERT INTO `projekt` VALUES ('','".mysqli_real_escape_string($username)."','".mysqli_real_escape_string($password_hash)."','".mysqli_real_escape_string($firstname)."','".mysqli_real_escape_string($surname)."','".$admin. "')";
                    $query = "INSERT INTO projekt (username, password, firstname, surname, admin) VALUES ('$username', '$password_hash', '$firstname','$surname','$admin')";
                    if ($query_run = mysqli_query($mysqli, $query)) {
                        header('Location:fooldal.php');

                    } else {
                        $error = "Nem sikerult a regisztracio, probalja ujra ";
                    }
                }
            }
        } else {
            $error = "Az egesz helyet tolcse ki! ";
        }
    }

    if (isset($_POST['Mégsem'])) {
        header("Location: fooldal.php");
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="register_style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="index.js"></script>
    </head>
    <body class="hatter_login">
    <form action="register.php" method="POST">
        <div class="vid-container">
            <div class="inner-container">
                <div class="box" name="reg_data">
                    <h1>Register</h1>
                    <span class="span_error"><p><?php echo "$error"; ?></p></span>
                    <input type="text" name="username" placeholder="Username" pattern="[A-Za-z0-9 ]{4,}" title="Legalabb 4 karakteres legyen." required/>
<!--                    (6-10 db, kisbetu is nagybetu is es szamjegye is legyen)-->
                    <input type="password" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,10}" title=" 6-10 db, kisbetu is nagybetu is es szamjegye is legyen." required/>
                    <input type="password" id="password_again" name="password_again" placeholder="Password2" required/>
                    <input type="text" name="firstname" placeholder="Firstnme" pattern="[a-zA-Z]{2,}" title="Csak betuket tartalmazhat, minimum 2 karakteres legyen." required />
                    <input type="text" name="surname" placeholder="Surname"  pattern="[a-zA-Z]{2,}" title="Csak betuket tartalmazhat." required/>
                    <div>
                        <button type="submit" class="login_button">Register</button>
                        <button onclick="goBack()" name="Mégsem" value="Mégsem" id="kuldes" class="register_button">Mégsem</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <script src="upload/js/jquery.min.js"></script>
    <script src="upload/js/bootstrap.js"></script>
    </body>
    </html>

    <?php
} else if (loggedin()) {
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