<?php
include_once('Classes/Connection.php');
include_once('Classes/RentProperty.php');

$Title = $_POST['Title'];
$Description = $_POST['Description'];
$Currency = $_POST['Currency'];
$Price = $_POST['Price'];
$Location = $_POST['Location'];
$Bedroom = $_POST['Bedroom'];
$Bathroom = $_POST['Bathroom'];
$MinimumContract = $_POST['MinimumContract'];
$BuildingArea = $_POST['BuildingArea'];
$LandArea = $_POST['LandArea'];
if(isset($_POST['FunitureIncluded'])){$FunitureIncluded= 1;}else{$FunitureIncluded=0;}
$Marketing = $_POST['Marketing'];
if(isset($_POST['Featured'])){$Featured= 1;}else{$Featured=0;}
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/RentPropertys/';
$FileName = $_FILES['MapImage']['name'];     
$tmpName  = $_FILES['MapImage']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_defaultConnection();
	$RentProperty = new RentProperty($Conn);
	$RentProperty->Title = $Title;
	$RentProperty->Description = $Description;
	$RentProperty->Currency = $Currency;
	$RentProperty->Price = $Price;
	$RentProperty->Location = $Location;
	$RentProperty->Bedroom = $Bedroom;
	$RentProperty->Bathroom = $Bathroom;
	$RentProperty->MinimumContract = $MinimumContract;
	$RentProperty->BuildingArea = $BuildingArea;
	$RentProperty->LandArea = $LandArea;
	$RentProperty->FunitureIncluded = $FunitureIncluded;
	$RentProperty->Marketing = $Marketing;
	$RentProperty->Featured = $Featured;
	$RentProperty->Active = $Active;
	$RentProperty->MapImage = $FileName;
	if($FileName == $Stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $UploadFile);
		}
	$RentProperty->Save();
	$Conn->Commit();

	header('location:RentProperty.php');
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>