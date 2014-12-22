<?php
include_once('Classes/Connection.php');
include_once('Classes/Location.php');

$Id = $_POST['Id'];
$Code = $_POST['Code'];
$Name = $_POST['Name'];

try {
	$conn = Connection::get_DefaultConnection();
	$Location = Location::GetObjectByKey($conn, $Id);
	$Location->Code = $Code;
	$Location->Name = $Name;
	$Location->Update();
	$conn->Commit();

	header('location:Location.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>