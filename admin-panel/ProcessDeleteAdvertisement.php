<?php
include_once('Classes/Connection.php');
include_once('Classes/Advertisement.php');
session_start();
$Id = $_GET['Id'];

try {
	$conn = Connection::get_DefaultConnection();
	Advertisement::Delete($conn, $Id);
	$conn->Commit();

	header('location:Advertisement.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>