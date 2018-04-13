<?php
require 'core.inc.php';
require 'connection.php';

if (loggedin()) {
    ?>
    <!DOCTYPE html>
    <html id="hatter">
    <head>
        <title>House sales</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="fooldal.css">
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="index.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
    <div id="wapper">
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
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Hirdetesek </a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav" id="nav">
                        <li><a href="insert_data">Insert New Post</a></li>
                        <li><a href="admin_search">Search</a></li>
                        <li><a href="user_posts">My Posts</a></li>
                        <li><a href="users">Users</a></li>
                        <li><a href="mails">Mail</a></li>
                        <li><a href="users_data">Settings</a></li>
                        <button type="submit" class="logout_button" onclick="location.href ='logout.php';">Log Out
                        </button>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="content" class="margin_set_login"></div>
    </div>
    </body>
    </html>
    <?php
} else {
    header('Location:startPage.php');
}
?>