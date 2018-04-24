<?php
require 'connection/connect_to_session.php';

if (!loggedin()) {

	require 'connection/login_connection.php';

	$unameErr = $passwordErr = "";
	$username = $password = $user_id = $admin_num = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Check if username is empty
		if (empty(trim($_POST["username"]))) {
			$unameErr = "Username is required";
		} else {
			$username = trim($_POST["username"]);
		}

		// Check if password is empty
		if (empty(trim($_POST["password"]))) {
			$passwordErr = "Password is required";
		} else {
			$password = trim($_POST["password"]);
		}

		// Validate credentials
		if (empty($unameErr) && empty($passwordErr)) {
			// Prepare a select statement
			$sql = "SELECT id, username, password FROM projekt WHERE username = ?";
			if ($stmt = mysqli_prepare($conn, $sql)) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				// Set parameters
				$param_username = $username;

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Store result
					mysqli_stmt_store_result($stmt);

					// Check if username exists, if yes then verify password
					if (mysqli_stmt_num_rows($stmt) == 1) {
						// Bind resultz variables
						mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);
						if (mysqli_stmt_fetch($stmt)) {
							if (password_verify($password, $hashed_password)) {
								/* Password is correct, so check if the user is admin or not */

								$admin = "SELECT admin FROM projekt WHERE id=?";
								if ($stmt = mysqli_prepare($conn, $admin)) {
									// Bind variables to the prepared statement as parameters
									mysqli_stmt_bind_param($stmt, "s", $param_admin);

									// Set parameters
									$param_admin = $user_id;

									// Attempt to execute the prepared statement
									if (mysqli_stmt_execute($stmt)) {
										// Store result
										mysqli_stmt_store_result($stmt);

										// Check if username exists, if yes then verify password
										if (mysqli_stmt_num_rows($stmt) == 1) {
											// Bind resultz variables
											mysqli_stmt_bind_result($stmt, $admin_num);
											if (mysqli_stmt_fetch($stmt)) {

												/*start new session and save the user_id to the session*/
												$_SESSION['user_id'] = $user_id;
												//if the user is admin, then the $admin_sza, has to be = to 1
												if ($admin_num == 1) {
													header('Location: admin.php');
													exit();
												} else {
													header('Location:index.php');
													exit;

												}
											}
										}
									}
								}

							} else {
								// Display an error message if password is not valid
								$passwordErr = 'The password you entered was not valid.';
							}
						}
					} else {
						// Display an error message if username doesn't exist
						$unameErr = 'No account found with that username.';
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}

		// Close connection
		mysqli_close($conn);

	}
	//if we press the back button
	if (isset($_POST['Back'])) {
		header("Location: startPage.php");
	}
	?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="stilus1.css" rel="stylesheet" type="text/css">

</head>
<body class="hatter_login" id=login_body>
<form method="POST" action="<?php echo htmlspecialchars(($_SERVER["PHP_SELF"])); ?>">
    <div class="vid-container">
        <div class="inner-container">
            <div class="box">
                <h1>Login</h1>

                <input type="text" name="username" placeholder="Username"/>
                <input type="password" name="password" placeholder="Password"/>
                <div>
                    <button type="submit" class="login_button" value="Login">Login</button>
                    <button type="submit" class="back_button" name="Back">Back</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
</body>
</html>
<?php }?>