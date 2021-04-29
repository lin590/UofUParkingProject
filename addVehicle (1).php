<?php

$page_roles = array('admin');

require_once "dbinfo.php";
require_once "checksession.php";

//Not sure what this page will be called, but we need this to check log-in credentials: require_once 'dbinfo.php';
//I would say we want this as well. This file is right from the lab, here's code to link: require_once 'checksession.php';

//LINE 3: Right now, just the admin can edit this table for add vehicle. This should be correct
//LINE 29: Not sure what the view vehciel page is called, just took a guess (likely needs to be changed)
//LINE 30: Not sure if we want a logout page here. If so, we can copy code from lab for logout.php. Or, just remove it
//LINE 48: Not sure what our SQL is called yet for this - needs to be changed from classics to the correct name (ex: INSERT INTO [name])

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<form action="addVehicle (1).php" method="post"<pre>
	Vehicle ID <input type="text" name="Vehicle_ID"></br></br>
	Driver_ID <input type="text" name="Driver_ID"></br></br>
	Vehicle Make <input type="text" 
name="Make"></br></br>
	Vehicle Model <input type="text" name="Model"></br></br>
	Vehicle Color <input type="text" name="Color"></br></br>
	Vehicle Year <input type="text" name="Year"></br></br>
	Vehicle VIN <input type="text" name="Vin"></br></br>
	Vehicle License Plate <input type="text" name="License_Plate"></br></br>
	
	<input type="submit" name="ADD VEHICLE">
	</br></br>
	
	<a href="viewUsers.php" >View Users</a>
	<a href="Logout.php">Logout</a>
	<a href="viewVehicleInfo.php" >View Vehicles</a>
	<a href="generatereports (1).php" >View Reports</a>
	<a href="updatePersonalInfo.php" >Update Personal Info</a>
	<a href="purchasePermit.php" >View Purchase Page</a>
	<a href="AddDriver.php" >Add Driver</a>
	<a href="addVehicle (1).php" >Add Vehicle</a>
	<a href="makeaviolationpayment (1).php" >Pay Violation</a>
</pre></form>
_END;


if(isset($_POST['Vehicle_ID']) &&
	isset($_POST['Driver_ID']) &&
	isset($_POST['Make']) &&
	isset($_POST['Model']) &&
	isset($_POST['Color']) &&
	isset($_POST['Year']) &&
	isset($_POST['Vin']) &&
	isset($_POST['License_Plate'])) {
		$Vehicle_ID=get_post($conn, 'Vehicle_ID');
		$Driver_ID=get_post($conn, 'Driver_ID');
		$Make=get_post($conn, 'Make');
		$Model=get_post($conn, 'Model');
		$Color=get_post($conn, 'Color');
		$Year=get_post($conn, 'Year');
		$Vin=get_post($conn, 'Vin');
		
	$License_Plate=get_post($conn, 'License_Plate');
		
		$query="INSERT INTO Vehicle (Vehicle_ID, Driver_ID, Make, Model, Color, Year, Vin, License_Plate) VALUES ".
			"('$Vehicle_ID','$Driver_ID','$Make','$Model','$Color','$Year','$Vin','$License_Plate')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
	
}

$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
	//Return to the viewVehiclesPage page
	header("Location: viewVehicleInfo.php");
}

?>