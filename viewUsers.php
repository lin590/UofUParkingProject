<?php

$page_roles = array('admin');


require_once 'dbinfo.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="SELECT * FROM Driver";
$result=$conn->query($query);
if(!$result) die ($conn->error);

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);

	
	echo <<<_END
	<pre>
		FirstName: $row[First_Name];
		LastName: $row[Last_Name];
		License: $row[License_Number];
		Driver ID: $row[Driver_ID];
		Email: $row[Email_Address];
		Phone: $row[Phone_Number]
		Address: $row[Address]
	</pre>
	<form action='DeleteDriver.php' method='post'>
		<input type='hidden' name='delete' value='yes'>
		<input type='hidden' name='Driver_ID' value='$row[Driver_ID]'>
		<input type='submit' value='DELETE User'>	
	</form>
_END;
}

echo <<<_END
<a href="viewUsers.php" >View Users</a>
<a href="Logout.php">Logout</a>
<a href="viewVehicleInfo.php" >View Vehicles</a>
<a href="generatereports (1).php" >View Reports</a>
<a href="updatePersonalInfo.php" >Update Personal Info</a>
<a href="purchasePermit.php" >View Purchase Page</a>
<a href="AddDriver.php" >Add Driver</a>
<a href="addVehicle (1).php" >Add Vehicle</a>
<a href="makeaviolationpayment (1).php" >Pay Violation</a>
_END;

$result->close();
$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
	
}



?>