<?php
include_once('Classes/Connection.php');
include_once('Classes/SecondaryProperty.php');
$Id = $_GET['Id'];

try {
	$Conn = Connection::get_DefaultConnection();
	SecondaryProperty::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:SecondaryProperty.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>