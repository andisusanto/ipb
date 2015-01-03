<?php
include_once('Classes/Connection.php');
include_once('Classes/Land.php');
$Id = $_GET['Id'];

try {
	$Conn = Connection::get_DefaultConnection();
	Land::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:Land.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>