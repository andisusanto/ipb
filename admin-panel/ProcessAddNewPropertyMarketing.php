<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyMarketing.php');

$NewPropertyId = $_POST['NewPropertyId'];
$Marketing = $_POST['Marketing'];

try {
	$Conn = Connection::get_DefaultConnection();
	$NewPropertyMarketing = new NewPropertyMarketing($Conn);
	$NewPropertyMarketing->NewProperty = $NewPropertyId;
	$NewPropertyMarketing->Marketing = $Marketing;
	$NewPropertyMarketing->Save();
	$Conn->Commit();

	header('location:NewPropertyMarketing.php?Id='.$NewPropertyId);
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>