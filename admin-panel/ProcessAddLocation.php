<?php
include_once('Classes/Connection.php');
include_once('Classes/Location.php');

$Code = $_POST['Code'];
$Name = $_POST['Name'];

try {
	$conn = Connection::get_defaultConnection();
	$Location = new Location($conn);
	$Location->Code = $Code;
	$Location->Name = $Name;
	$Location->Save();
	$conn->Commit();

	header('location:Location.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>