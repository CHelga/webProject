<!-- <?php
require 'core.inc.php';
require 'connection.php';
	
	$hirdetes = $_GET['felh'];	
	
	$sql = "SELECT * FROM projekt WHERE id=$hirdetes ";
	$myData = mysqli_query($mysqli, $sql);

		while ($record = mysqli_fetch_assoc($myData)){  
		$username = $record['username'];  
		$firstname = $record['firstname'];    
		$surname = $record['surname'];  	
			
			echo $username."|";
			echo $firstname."|";
			echo $surname."|";
		}
?>
 -->