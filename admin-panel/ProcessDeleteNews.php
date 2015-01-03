<?php
include_once('Classes/Connection.php');
include_once('Classes/News.php');
session_start();
$Id = $_GET['Id'];

try {
	$conn = Connection::get_DefaultConnection();
	News::Delete($conn, $Id);
	$conn->Commit();

	header('location:News.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>