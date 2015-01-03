<?php
include_once('Classes/Connection.php');
include_once('Classes/RentPropertyImage.php');

$Id = $_GET['Id'];
$RentPropertyId = $_GET['RentPropertyId']; 

try {
	$Conn = Connection::get_DefaultConnection();
	RentPropertyImage::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:RentPropertyImage.php?Id='.$RentPropertyId);
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>