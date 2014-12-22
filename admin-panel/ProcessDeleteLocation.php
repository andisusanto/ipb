<?php
include_once('Classes/Connection.php');
include_once('Classes/Location.php');
$Id = $_GET['Id'];

try {
	$conn = Connection::get_DefaultConnection();
	Location::Delete($conn, $Id);
	$conn->Commit();

	header('location:Location.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>