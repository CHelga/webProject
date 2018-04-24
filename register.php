<?php
require 'connection/connect_to_session.php';
if (loggedin()) {
	$admin_e = $_SESSION['admin'];
	if ($admin_e != 0) {
		header('Location:admin.php');
		exit();
	} else {
		header('Location:index.php');
		exit();
	}
} else if (!loggedin()) {

	require 'connection/connection.php';

	$unameErr = $passwordErr = $password2Err = $fnameErr = $surnameErr = "";
	$uname = $password = $password2 = $fname = $surname = "";
// when first accessing the page to avoid empty insert, if we processed the data then it will be true
	$washere = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Validate username
		if (empty(trim($_POST["uname"]))) {
			$unameErr = "Please enter a username.";
		} else {
			// Prepare a select statement
			$sql = "SELECT id FROM projekt WHERE username = ?";

			if ($stmt = mysqli_prepare($mysqli, $sql) or die(mysqli_error($mysqli))) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				// Set parameters
				$param_username = trim($_POST["uname"]);

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					/* store result */
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) == 1) {
						$unameErr = "This username is already taken.";
					} else {
						$uname = trim($_POST["uname"]);
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}

		// Validate password
		if (empty(trim($_POST['password']))) {
			$passwordErr = "Please enter a password.";
		} elseif (strlen(trim($_POST['password'])) < 5) {
			$passwordErr = "Password must have atleast 5 characters.";
		} else {
			$password = trim($_POST['password']);
		}

		if (empty(trim($_POST["password2"]))) {
			$password2Err = "Password is required";
		} else {
			$password2 = trim($_POST["password2"]);
			if ($password != $password2) {
				$password2Err = "The passwords does not match.";
			}
		}

		if (empty(trim($_POST["fname"]))) {
			$fnameErr = "Fist name is required";
		} else {
			$fname = trim($_POST["fname"]);
			if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
				$fnameErr = "Only letters and white space allowed";
			}
		}

		if (empty(trim($_POST["surname"]))) {
			$surnameErr = "Last name is required";
		} else {
			$surname = trim($_POST["surname"]);
			if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
				$surnameErr = "Only letters and white space allowed";
			}
		}
		// Check input errors before inserting in database
		if (empty($unameErr) && empty($passwordErr) && empty($password2Err) && empty($fnameErr) && empty($surnameErr)) {

			// Prepare an insert statement
			$sql = "INSERT INTO projekt (username, password, firstname, surname, admin) VALUES (?, ?, ?, ?, ?)";

			if ($stmt = mysqli_prepare($mysqli, $sql) or die(mysqli_error($mysqli))) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_fname, $param_surname, $param_admin);

				// Set parameters
				$param_username = $uname;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				$param_fname = $fname;
				$param_surname = $surname;
				$param_admin = 0;

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Redirect to the start page
					header('Location: startPage.php');
					exit;
				} else {
					echo "Something went wrong. Please try again later.";
				}
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}

		// Close connection
		mysqli_close($mysqli);
	}

	?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="register_style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="index.js"></script>
    </head>
     <body class="hatter_login">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    	<div class="vid-container">
            <div class="inner-container">
                <div class="box" name="reg_data">
                     <h1>Register</h1>

                     <input type="text" name="uname" placeholder="Username" required>
                     <!-- <span class="error"><p><?php echo $unameErr; ?></p></span> -->

					 <input type="password" id="password" name="password" placeholder="Password" required>
					 <!-- <span class="error">* <?php echo $passwordErr; ?></span> -->

					 <input type="password" id="password_again" name="password2" placeholder="Password2" required>
					 <!-- <span class="error">* <?php echo $password2Err; ?></span> -->

					 <input type="text" name="fname" id="fname", placeholder="Fist name" required>
					 <!-- <span class="error">* <?php echo $fnameErr; ?></span> -->

                    <input type="text" name="surname" placeholder="Surname" required>
                    <!-- <span class="error">* <?php echo $surnameErr; ?></span> -->

                    <div>
                        <button type="submit" class="login_button">Register</button>
                        <button onclick="goBack()" name="Mégsem" value="Mégsem" id="kuldes" class="register_button">Back</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    </body>

    </html>
    <?php
}
?>