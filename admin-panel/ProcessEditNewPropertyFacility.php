<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyFacility.php');

$Id = $_POST['Id'];
$NewPropertyId = $_POST['NewPropertyId'];
$Facility = $_POST['Facility'];

try {
	$Conn = Connection::get_DefaultConnection();
	$NewPropertyFacility = NewPropertyFacility::GetObjectByKey($Conn, $Id);
	$NewPropertyFacility->Facility = $Facility;
	$NewPropertyFacility->Update();
	$Conn->Commit();

	header('location:NewPropertyFacility.php?Id='.$NewPropertyId);
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>