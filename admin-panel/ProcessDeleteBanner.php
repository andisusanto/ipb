<?php
include_once('Classes/Connection.php');
include_once('Classes/Banner.php');
session_start();
$Id = $_GET['Id'];

try {
	$conn = Connection::get_DefaultConnection();
	Banner::Delete($conn, $Id);
	$conn->Commit();

	header('location:Banner.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>