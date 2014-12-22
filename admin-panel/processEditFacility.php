<?php
include_once('Classes/Connection.php');
include_once('Classes/Facility.php');
session_start();
$Id = $_POST['Id'];
$Code = $_POST['Code'];
$Name = $_POST['Name'];

try {
	$conn = Connection::get_DefaultConnection();
	$facility = Facility::GetObjectByKey($conn, $Id);
	$facility->Code = $Code;
	$facility->Name = $Name;
	$facility->Update();
	$conn->Commit();

	header('location:Facility.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>