<?php
include_once('Classes/Connection.php');
include_once('Classes/NewProperty.php');

$Id = $_POST['Id'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
$Currency = $_POST['Currency'];
$MinPrice = $_POST['MinPrice'];
$MaxPrice = $_POST['MaxPrice'];
$Location = $_POST['Location'];
$Bedroom = $_POST['Bedroom'];
$Bathroom = $_POST['Bathroom'];
$Foundation = $_POST['Foundation'];
$Platfond = $_POST['Platfond'];
$RoofFrame = $_POST['RoofFrame'];
$Roof = $_POST['Roof'];
$Wall = $_POST['Wall'];
$MainDoor = $_POST['MainDoor'];
$Window = $_POST['Window'];
$Floor = $_POST['Floor'];
if(isset($_POST['Featured'])){$Featured= 1;}else{$Featured=0;}
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/NewPropertys/';
$FileName = $_FILES['MapImage']['name'];     
$tmpName  = $_FILES['MapImage']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_DefaultConnection();
	$NewProperty = NewProperty::GetObjectByKey($Conn, $Id);
	$NewProperty->Title = $Title;
	$NewProperty->Description = $Description;
	$NewProperty->Currency = $Currency;
	$NewProperty->MinPrice = $MinPrice;
	$NewProperty->MaxPrice = $MaxPrice;
	$NewProperty->Location = $Location;
	$NewProperty->Bedroom = $Bedroom;
	$NewProperty->Bathroom = $Bathroom;
	$NewProperty->Foundation = $Foundation;
	$NewProperty->Platfond = $Platfond;
	$NewProperty->RoofFrame = $RoofFrame;
	$NewProperty->Roof = $Roof;
	$NewProperty->Wall = $Wall;
	$NewProperty->MainDoor = $MainDoor;
	$NewProperty->Window = $Window;
	$NewProperty->Floor = $Floor;
	$NewProperty->Featured = $Featured;
	$NewProperty->Active = $Active;
		if($FileName !== $Stamp.'-'){
			move_uploaded_file($tmpName, $UploadFile);
			$NewProperty->MapImage = $FileName;
		}
	$NewProperty->Update();
	$Conn->Commit();

	
	header('location:NewProperty.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>