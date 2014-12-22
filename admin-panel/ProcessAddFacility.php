<?php
include_once('Classes/Connection.php');
include_once('Classes/Facility.php');

$Code = $_POST['Code'];
$Name = $_POST['Name'];

try {
	$conn = Connection::get_defaultConnection();
	$facility = new Facility($conn);
	$facility->Code = $Code;
	$facility->Name = $Name;
	$facility->Save();
	$conn->Commit();

	header('location:Facility.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>