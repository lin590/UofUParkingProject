<?php

require_once 'dbinfo.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

//code for create user table here
$query = "create table login(
	username varchar(128) not null unique,
	password text not null
)";

$result = $conn->query($query);
if(!$result) die($conn->error);

//Bill Smith
$username = 'bsmith';
$password = 'mysecret';

$token = password_hash($password,PASSWORD_DEFAULT); 

add_user($conn, $username, $token);

//Pauline Jones
$username = 'pjones';
$password = 'acrobat';
$token = password_hash($password,PASSWORD_DEFAULT);

add_user($conn, $username, $token);

function add_user($conn, $username, $token){
	//code to add user here
	$query = "insert into users(username, password) values ('$username', '$token')";
	$result = $conn->query($query);
	if(!$result) die($conn->error);
}


?>




