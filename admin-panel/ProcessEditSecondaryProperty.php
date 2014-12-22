<?php
include_once('Classes/Connection.php');
include_once('Classes/SecondaryProperty.php');

$Id = $_POST['Id'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
$Currency = $_POST['Currency'];
$Price = $_POST['Price'];
$Location = $_POST['Location'];
$Bedroom = $_POST['Bedroom'];
$Bathroom = $_POST['Bathroom'];
$Deposit = $_POST['Deposit'];
$TimeRange = $_POST['TimeRange'];
$EstimatedInterestRate = $_POST['EstimatedInterestRate'];
$BuildingArea = $_POST['BuildingArea'];
$LandArea = $_POST['LandArea'];
$Certificate = $_POST['Certificate'];
if(isset($_POST['FunitureIncluded'])){$FunitureIncluded = 1;}else{$FunitureIncluded = 0;}
$Marketing = $_POST['Marketing'];
if(isset($_POST['Featured'])){$Featured= 1;}else{$Featured=0;}
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}

try {
	$Conn = Connection::get_DefaultConnection();
	$SecondaryProperty = SecondaryProperty::GetObjectByKey($Conn, $Id);
	$SecondaryProperty->Title = $Title;
	$SecondaryProperty->Description = $Description;
	$SecondaryProperty->Currency = $Currency;
	$SecondaryProperty->Price = $Price;
	$SecondaryProperty->Location = $Location;
	$SecondaryProperty->LandArea = $LandArea;
	$SecondaryProperty->Bedroom = $Bedroom;
	$SecondaryProperty->Bathroom = $Bathroom;
	$SecondaryProperty->BuildingArea = $BuildingArea;
	$SecondaryProperty->Deposit = $Deposit;
	$SecondaryProperty->TimeRange = $TimeRange;
	$SecondaryProperty->EstimatedInterestRate = $EstimatedInterestRate;
	$SecondaryProperty->Certificate = $Certificate;
	$SecondaryProperty->Marketing = $Marketing;
	$SecondaryProperty->FunitureIncluded = $FunitureIncluded;
	$SecondaryProperty->Featured = $Featured;
	$SecondaryProperty->Active = $Active;
	$SecondaryProperty->Update();
	$Conn->Commit();

	header('location:SecondaryProperty.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>