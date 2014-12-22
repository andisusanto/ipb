<?php
include_once('Classes/Connection.php');
include_once('Classes/SecondaryPropertyImage.php');

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

	$SecondaryPropertyImage = new SecondaryPropertyImage($Conn);
	$SecondaryPropertyImage->SecondaryProperty = $SecondaryPropertyId;
	$SecondaryPropertyImage->ImageName = $FileName;
	$SecondaryPropertyImage->Active = $Active;
	if($FileName == $Stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $UploadFile);
		}
	$SecondaryPropertyImage->Save();
	$Conn->Commit();

	header('location:SecondaryPropertyImage.php?Id='.$SecondaryPropertyId);
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>