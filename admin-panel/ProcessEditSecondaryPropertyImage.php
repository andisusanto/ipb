<?php
include_once('Classes/Connection.php');
include_once('Classes/SecondaryPropertyImage.php');

$Id = $_POST['Id'];
$SecondaryPropertyId = $_POST['SecondaryPropertyId'];

if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/SecondaryPropertys/';
$FileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_DefaultConnection();
	$SecondaryPropertyImage = SecondaryPropertyImage::GetObjectByKey($Conn, $Id);
	$SecondaryPropertyImage->Active = $Active;
	if($FileName !== $Stamp.'-'){
			move_uploaded_file($tmpName, $UploadFile);
			$SecondaryPropertyImage->ImageName = $FileName;
		}
	$SecondaryPropertyImage->Update();
	$Conn->Commit();

	header('location:SecondaryPropertyImage.php?Id='.$SecondaryPropertyId);
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>