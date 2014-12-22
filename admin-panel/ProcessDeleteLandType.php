<?php
include_once('Classes/Connection.php');
include_once('Classes/LandType.php');
session_start();
$Id = $_GET['Id'];

try {
	$conn = Connection::get_DefaultConnection();
	LandType::Delete($conn, $Id);
	$conn->Commit();

	header('location:LandType.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>