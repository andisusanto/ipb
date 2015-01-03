<?php
include_once('Classes/Connection.php');
include_once('Classes/LandImage.php');

$LandId = $_POST['LandId'];
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/Lands/';
$FileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_DefaultConnection();

	$LandImage = new LandImage($Conn);
	$LandImage->Land = $LandId;
	$LandImage->ImageName = $FileName;
	$LandImage->Active = $Active;
	if($FileName == $Stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $UploadFile);
		}
	$LandImage->Save();
	$Conn->Commit();

	header('location:LandImage.php?Id='.$LandId);
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>