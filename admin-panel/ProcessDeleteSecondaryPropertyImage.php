<?php
include_once('Classes/Connection.php');
include_once('Classes/SecondaryPropertyImage.php');

$Id = $_GET['Id'];
$SecondaryPropertyId = $_GET['SecondaryPropertyId']; 

try {
	$Conn = Connection::get_DefaultConnection();
	SecondaryPropertyImage::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:SecondaryPropertyImage.php?Id='.$SecondaryPropertyId);
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>