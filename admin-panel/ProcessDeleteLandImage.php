<?php
include_once('Classes/Connection.php');
include_once('Classes/LandImage.php');

$Id = $_GET['Id'];
$LandId = $_GET['LandId']; 

try {
	$Conn = Connection::get_DefaultConnection();
	LandImage::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:LandImage.php?Id='.$LandId);
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>