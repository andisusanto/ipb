<?php
include_once('Classes/Connection.php');
include_once('Classes/RentPropertyImage.php');

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

	$RentPropertyImage = new RentPropertyImage($Conn);
	$RentPropertyImage->RentProperty = $RentPropertyId;
	$RentPropertyImage->ImageName = $FileName;
	$RentPropertyImage->Active = $Active;
	if($FileName == $Stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $UploadFile);
		}
	$RentPropertyImage->Save();
	$Conn->Commit();

	header('location:RentPropertyImage.php?Id='.$RentPropertyId);
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>