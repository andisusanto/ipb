<?php
include_once('Classes/Connection.php');
include_once('Classes/Advertisement.php');

$Link = $_POST['Link'];
if(isset($_POST['ShowOnHome'])){$ShowOnHome = 1;}else{$ShowOnHome = 0;}
if(isset($_POST['ShowOnContact'])){$ShowOnContact = 1;}else{$ShowOnContact = 0;}
if(isset($_POST['ShowOnNewPropertyListing'])){$ShowOnNewPropertyListing = 1;}else{$ShowOnNewPropertyListing = 0;}
if(isset($_POST['ShowOnSecondaryPropertyListing'])){$ShowOnSecondaryPropertyListing = 1;}else{$ShowOnSecondaryPropertyListing = 0;}
if(isset($_POST['ShowOnRentPropertyListing'])){$ShowOnRentPropertyListing = 1;}else{$ShowOnRentPropertyListing = 0;}
if(isset($_POST['ShowOnLandForSaleListing'])){$ShowOnLandForSaleListing = 1;}else{$ShowOnLandForSaleListing = 0;}
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$DueDate = $_POST['DueDate'];
$stamp = date('Y-m-d-h-s');
$uploaddir = '../images/Advertisements/';
$fileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$fileName = $stamp.'-'.$fileName;
$uploadfile = $uploaddir . $fileName;

try {
	$conn = Connection::get_defaultConnection();
	$Advertisement = new Advertisement($conn);
	$Advertisement->ImageName = $fileName;
	$Advertisement->Link = $Link;
	$Advertisement->ShowOnHome = $ShowOnHome;
	$Advertisement->ShowOnContact = $ShowOnContact;
	$Advertisement->ShowOnNewPropertyListing = $ShowOnNewPropertyListing;
	$Advertisement->ShowOnSecondaryPropertyListing = $ShowOnSecondaryPropertyListing;
	$Advertisement->ShowOnRentPropertyListing = $ShowOnRentPropertyListing;
	$Advertisement->ShowOnLandForSaleListing = $ShowOnLandForSaleListing;
	$Advertisement->DueDate = $DueDate;
	$Advertisement->Active = $Active;
	if($fileName == $stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $uploadfile);
		}
	echo $Advertisement->get_SaveQuery();
	$Advertisement->Save();
	$conn->Commit();

	header('location:Advertisement.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>