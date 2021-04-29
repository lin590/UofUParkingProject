<?php

$page_roles = array('admin');

require_once "dbinfo.php";
require_once "checksession.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<form action="AddDriver.php" method="post"<pre>
	License_Number <input type="text" name="License_Number"></br></br>
	Driver_ID <input type="text" name="Driver_ID"></br></br>
	First_Name <input type="text" name="First_Name"></br></br>
	Last_Name <input type="text" name="Last_Name"></br></br>
	Email_Address <input type="text" name="Email_Address"></br></br>
	Phone_Number <input type="text" name="Phone_Number"></br></br>
	Address <input type="text" name="Address"></br></br>
	Driver_Type <input type="text" name="Driver_Type"></br></br>
	
	<input type="submit" name="ADD DRIVER">
	</br></br>
	
	<a href="viewUsers.php" >View Users</a>
	<a href="Logout.php">Logout</a>
	<a href="viewVehicleInfo.php" >View Vehicles</a>
	<a href="generatereports (1).php" >View Reports</a>
	<a href="updatePersonalInfo.php" >View Personal Info</a>
	<a href="purchasePermit.php" >View Purchase Page</a>
	<a href="AddDriver.php" >Add Driver</a>
	<a href="addVehicle (1).php" >Add Vehicle</a>
	<a href="makeaviolationpayment (1).php" >Pay Violation</a>
</pre></form>
_END;


if(isset($_POST['License_Number']) &&
	isset($_POST['Driver_ID']) &&
	isset($_POST['First_Name']) &&
	isset($_POST['Last_Name']) &&
	isset($_POST['Email_Address']) &&
	isset($_POST['Phone_Number']) &&
	isset($_POST['Address']) &&
	isset($_POST['Driver_Type'])) {
		$License_Number=get_post($conn, 'License_Number');
		$Driver_ID=get_post($conn, 'Driver_ID');
		$First_Name=get_post($conn, 'First_Name');
		$Last_Name=get_post($conn, 'Last_Name');
		$Email_Address=get_post($conn, 'Email_Address');
		$Phone_Number=get_post($conn, 'Phone_Number');
		$Address=get_post($conn, 'Address');
		$Driver_Type=get_post($conn, 'Driver_Type');
		
		$query="INSERT INTO driver (License_Number, Driver_ID, First_Name, Last_Name, Email_Address, Phone_Number, Address, Driver_Type) VALUES ".
			"('$License_Number','$Driver_ID','$First_Name','$Last_Name','$Email_Address','$Phone_Number','$Address','$Driver_Type')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
	
}

$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
	
	//Return to the viewVehiclesPage page
	header("Location: viewRecord.php");
}

?>