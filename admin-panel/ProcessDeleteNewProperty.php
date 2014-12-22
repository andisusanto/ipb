<?php
include_once('Classes/Connection.php');
include_once('Classes/NewProperty.php');
$Id = $_GET['Id'];

try {
	$Conn = Connection::get_DefaultConnection();
	NewProperty::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:NewProperty.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>