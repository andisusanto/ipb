<?php
include_once('Classes/Connection.php');
include_once('Classes/RentPropertyImage.php');

$Id = $_POST['Id'];
$RentPropertyId = $_POST['RentPropertyId'];

if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/RentPropertys/';
$FileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_DefaultConnection();
	$RentPropertyImage = RentPropertyImage::GetObjectByKey($Conn, $Id);
	$RentPropertyImage->Active = $Active;
	if($FileName !== $Stamp.'-'){
			move_uploaded_file($tmpName, $UploadFile);
			$RentPropertyImage->ImageName = $FileName;
		}
	$RentPropertyImage->Update();
   	$Conn->Commit();

	header('location:RentPropertyImage.php?Id='.$RentPropertyId);
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>