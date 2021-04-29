<html>
	<center>
	<head></head>
	
	<!--<img src=“utah.jpg" alt="Utah Logo" width="100" height="100"> -->
	<body style="background-color:firebrick;">
	
	<h1 style="font-family: Candara;text-align=center">University of Utah Parking Log-in</h1>

	<body>
		<form method='post' action='loginscreen.php'>
			Username: <input type='text' name='username'><br>
			Password: <input type='password' name='password'><br><br>
			<input type='submit' value='Login'>
		</form>
	</body>
		
		<h4 style="font-family: Optima;text-align=center">Need help signing-in? Contact us!<br>
		uofuparkingservices@utah.edu<br>
		801-777-9999</h4>

</html>

<?php

require_once 'dbinfo.php';
require_once 'User.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

 if (isset($_POST['username']) && isset($_POST['password'])) {
	
	$tmp_username = mysql_entities_fix_string($conn, $_POST['username']);
	$tmp_password = mysql_entities_fix_string($conn, $_POST['password']);
	
	$query = "SELECT password FROM users WHERE username = '$tmp_username'";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$rows = $result->num_rows;
	$passwordFromDB="";
	for($j=0; $j<$rows; $j++)
	{
		$result->data_seek($j); 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$passwordFromDB = $row['password'];
	
	}
	
	if(password_verify($tmp_password,$passwordFromDB))
	{
		echo "successful login<br>";

		$user = new User($tmp_username);

		session_start();
		$_SESSION['user'] = $user;

		header("Location: updatePersonalInfo.php");
	}
	else
	{
		echo "login error<br>";
	}	
	
}


$conn->close();


function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));	
}

function mysql_fix_string($conn, $string){
	$string = stripslashes($string);
	return $conn->real_escape_string($string);
}



?>