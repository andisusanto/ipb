<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyMarketing.php');

$Id = $_POST['Id'];
$NewPropertyId = $_POST['NewPropertyId'];
$Marketing = $_POST['Marketing'];

try {
	$Conn = Connection::get_DefaultConnection();
	$NewPropertyMarketing = NewPropertyMarketing::GetObjectByKey($Conn, $Id);
	$NewPropertyMarketing->Marketing = $Marketing;
	$NewPropertyMarketing->Update();
	$Conn->Commit();

	header('location:NewPropertyMarketing.php?Id='.$NewPropertyId);
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>