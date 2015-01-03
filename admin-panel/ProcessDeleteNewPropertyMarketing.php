<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyMarketing.php');

$Id = $_GET['Id'];
$NewPropertyId = $_GET['NewPropertyId']; 

try {
	$Conn = Connection::get_DefaultConnection();
	NewPropertyMarketing::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:NewPropertyMarketing.php?Id='.$NewPropertyId);
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>