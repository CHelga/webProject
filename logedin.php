<?php
/**
 * Created by PhpStorm.
 * User: Helga
 * Date: 2/7/2018
 * Time: 3:10 PM
 */

session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['uname'])) {
    header("location: login.php");
    exit;
}else {
    echo $_SESSION['uname'];
    ?>

    <a href="session_destroy.php">Logout</a>

    <?php
}
?>


<!DOCTYPE HTML>
<html>
<head>
        <title> User page </title>
<!--        <script>
            function showSuggestion(str) {
                if(str.length == 0){
                    document.getElementById("output").innerHTML = '';
                }else{
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if(this.readyState == 4 && this.status == 200){
                            document.getElementById('output').innerHTML = this.responseText;
                        }
                    }
                    //send the request to suggest.php with the string str (what we tiped in)
                    xmlhttp.open("GET", "suggest.php?q="+str, true);
                    xmlhttp.send();
                }
            }
        </script>
-->
    <!-- <?php require 'Server/Database/connect_to_data_list.php'; ?> -->
</head>
<body>
<!--    <h1>Search Users</h1>
    <form>
        Search User: <input type="text" class="form-control" onkeyup="showSuggestion(this.value)">
    </form>
    <p>Suggestions: <span id="output"></span></p>
-->

<!--         <?php
        $sql ='select * from userlist';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["userid"]. " - Price: " . $row["price"]. "  - color: " . $row["color"]. "  -size: " . $row["size"] . "<br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
 --></body>
</html>
