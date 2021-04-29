<?php

$page_roles = array('admin');
$page_roles = array('pjones');

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
<form action="makeaviolationpayment (1).php" method="post"<pre>
	VP_ID <input type="text" name="VP_ID"></br></br>
	Violation_ID <input type="text" name="Violation_ID"></br></br>
	Payment_ID <input type="text" name="Payment_ID"></br></br>
	Amount <input type="text" name="Amount"></br></br>
	
	<input type="submit" name="Make Payment">
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


if(isset($_POST['VP_ID']) &&
	isset($_POST['Violation_ID']) &&
	isset($_POST['Payment_ID']) &&
	isset($_POST['Amount'])) {
		$VP_ID=get_post($conn, 'VP_ID');
		$Violation_ID=get_post($conn, 'Violation_ID');
		$Payment_ID=get_post($conn, 'Payment_ID');
		$Amount=get_post($conn, 'Amount');
		
		
		$query="INSERT INTO violation_payment (VP_ID, Violation_ID, Payment_ID, Amount) VALUES ".
			"('$VP_ID','$Violation_ID','$Payment_ID','$Amount')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
	
}

$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
	//Return to the viewVehiclesPage page
	header("Location: generatereports (1).php");
}

?>