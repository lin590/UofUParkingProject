<?php

//import credentials for db
require_once  'dbinfo.php';

//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);



if(isset($_POST['delete']))
{
	$Driver_ID = $_POST['Driver_ID'];

	$query = "DELETE FROM driver WHERE Driver_ID='$Driver_ID' ";
	
	//Run the query
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	//Return to the viewVehiclesPage page
	header("Location: viewUsers.php");
	
}


?>