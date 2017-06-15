<?php
require 'login_connection.php';
require 'core.inc.php';

$error = '';
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $username = mysqli_real_escape_string($con, $_POST['username']);
                    $password = mysqli_real_escape_string($con, md5($_POST['password']));

                    if (!empty($username) && !empty($password)) {

                        $query = "SELECT `id` FROM `projekt` WHERE `username` = '$username' AND `password` = '$password' ";

                        if ($query_run = mysqli_query($con, $query)) {

                            $query_num_rows = mysqli_num_rows($query_run);

                            if ($query_num_rows == 0) {
                                $error = "Invalid username/password.";
                            } else if ($query_num_rows == 1) {
                                $row = mysqli_fetch_assoc($query_run);
                                $user_id = $row['id'];

                                $_SESSION['user_id'] = $user_id;
                                $admin = "SELECT admin FROM projekt WHERE id=$user_id";
                                $myData = mysqli_query($con, $admin);
                                while ($record = mysqli_fetch_object($myData)) {
                                    $admin_szam = $record->admin;
                                }
                                $_SESSION['admin'] = $admin_szam;

                                if ($admin_szam == 1) {
                                    header('Location:admin.php');
                                } else {
                                    header('Location:index.php');
                                }
                            }
                        } else {
                            $error = " you must supply a username and password";
                        }
                    } else {
                        $error = 'you must supply a username and password.';
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
    <link href="stilus1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="hatter_login">
<form action="" method="POST">
    <div class="vid-container">
        <div class="inner-container">
            <div class="box">
                <h1>Login</h1>

                <input type="text" name="username" placeholder="Username"/>
                <input type="password" name="password" placeholder="Password"/>
                <div>
                    <button type="submit" class="login_button">Login</button>
                    <button type="submit" class="back_button" name="Mégsem">Back</button>
                </div>
                <span class="span_error"><p><?php echo "$error"; ?></p></span>
            </div>
        </div>
    </div>
    </div>
</form>
</body>
</html>

