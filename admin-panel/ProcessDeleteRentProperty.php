<?php
include_once('Classes/Connection.php');
include_once('Classes/RentProperty.php');
$Id = $_GET['Id'];

try {
	$Conn = Connection::get_DefaultConnection();
	RentProperty::Delete($Conn, $Id);
	$Conn->Commit();

	header('location:RentProperty.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>