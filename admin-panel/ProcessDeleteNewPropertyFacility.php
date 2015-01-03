<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyFacility.php');

$Id = $_GET['Id'];
$NewPropertyId = $_GET['NewPropertyId']; 

try {
	$Conn = Connection::get_DefaultConnection();
	NewPropertyFacility::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:NewPropertyFacility.php?Id='.$NewPropertyId);
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>