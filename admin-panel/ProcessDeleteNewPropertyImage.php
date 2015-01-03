<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyImage.php');

$Id = $_GET['Id'];
$NewPropertyId = $_GET['NewPropertyId']; 

try {
	$Conn = Connection::get_DefaultConnection();
	NewPropertyImage::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:NewPropertyImage.php?Id='.$NewPropertyId);
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>