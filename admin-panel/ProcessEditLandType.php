<?php
include_once('Classes/Connection.php');
include_once('Classes/LandType.php');

$Id = $_POST['Id'];
$Code = $_POST['Code'];
$Name = $_POST['Name'];

try {
	$conn = Connection::get_DefaultConnection();
	$LandType = LandType::GetObjectByKey($conn, $Id);
	$LandType->Code = $Code;
	$LandType->Name = $Name;
	$LandType->Update();
	$conn->Commit();

	header('location:LandType.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>