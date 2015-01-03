<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyFacility.php');

$NewPropertyId = $_POST['NewPropertyId'];
$Facility = $_POST['Facility'];

try {
	$Conn = Connection::get_DefaultConnection();
	$NewPropertyFacility = new NewPropertyFacility($Conn);
	$NewPropertyFacility->NewProperty = $NewPropertyId;
	$NewPropertyFacility->Facility = $Facility;
	$NewPropertyFacility->Save();
	$Conn->Commit();

	header('location:NewPropertyFacility.php?Id='.$NewPropertyId);
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>