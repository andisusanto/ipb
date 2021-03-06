<?php
include_once('Classes/Connection.php');
include_once('Classes/NewPropertyImage.php');

$NewPropertyId = $_POST['NewPropertyId'];
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/NewPropertys/';
$FileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_DefaultConnection();

	$NewPropertyImage = new NewPropertyImage($Conn);
	$NewPropertyImage->NewProperty = $NewPropertyId;
	$NewPropertyImage->ImageName = $FileName;
	$NewPropertyImage->Active = $Active;
	if($FileName == $Stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $UploadFile);
		}
	$NewPropertyImage->Save();
	$Conn->Commit();

	header('location:NewPropertyImage.php?Id='.$NewPropertyId);
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>