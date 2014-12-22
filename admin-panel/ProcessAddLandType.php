<?php
include_once('Classes/Connection.php');
include_once('Classes/LandType.php');

$Code = $_POST['Code'];
$Name = $_POST['Name'];

try {
	$conn = Connection::get_DefaultConnection();
	$LandType = new LandType($conn);
	$LandType->Code = $Code;
	$LandType->Name = $Name;
	$LandType->Save();
	$conn->Commit();

	header('location:LandType.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>