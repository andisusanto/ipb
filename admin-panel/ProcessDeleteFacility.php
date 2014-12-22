<?php
include_once('Classes/Connection.php');
include_once('Classes/Facility.php');
session_start();
$Id = $_GET['Id'];

try {
	$conn = Connection::get_DefaultConnection();
	Facility::Delete($conn, $Id);
	$conn->Commit();

	header('location:Facility.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>