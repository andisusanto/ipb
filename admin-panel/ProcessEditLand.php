<?php
include_once('Classes/Connection.php');
include_once('Classes/Land.php');

$Id = $_POST['Id'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
$Currency = $_POST['Currency'];
$Price = $_POST['Price'];
$Location = $_POST['Location'];
$Area = $_POST['Area'];
$Category = $_POST['Category'];
$LandType = $_POST['LandType'];
$Certificate = $_POST['Certificate'];
$Condition = $_POST['Condition'];
$Marketing = $_POST['Marketing'];
$Featured = $_POST['Featured'];
$Active = $_POST['Active'];
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/Lands/';
$FileName = $_FILES['MapImage']['name'];     
$tmpName  = $_FILES['MapImage']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;


try {
	$Conn = Connection::get_DefaultConnection();
	$Land = Land::GetObjectByKey($Conn, $Id);
	$Land->Title = $Title;
	$Land->Description = $Description;
	$Land->Currency = $Currency;
	$Land->Price = $Price;
	$Land->Location = $Location;
	$Land->Area = $Area;
	$Land->Category = $Category;
	$Land->Condition = $Condition;
	$Land->Certificate = $Certificate;
	$Land->Martketing = $Martketing;
	$Land->Featured = $Featured;
	$Land->Active = $Active;
	if($FileName !== $Stamp.'-'){
			move_uploaded_file($tmpName, $UploadFile);
			$SecondaryPropertyImage->ImageName = $FileName;
		}
	$Land->Update();
	$Conn->Commit();

	header('location:Land.php');
} catch (Exception $e) {
	include('Classes/ErrorHandler.php');
}
?>