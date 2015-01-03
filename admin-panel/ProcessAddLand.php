<?php
include_once('Classes/Connection.php');
include_once('Classes/Land.php');

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
$WTO = $_POST['WTO'];

$Marketing = $_POST['Marketing'];
if(isset($_POST['Featured'])){$Featured= 1;}else{$Featured=0;}
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Stamp = date('Y-m-d-h-s');
$UploadDir = '../images/Lands/';
$FileName = $_FILES['MapImage']['name'];     
$tmpName  = $_FILES['MapImage']['tmp_name'];
$FileName = $Stamp.'-'.$FileName;
$UploadFile = $UploadDir . $FileName;

try {
	$Conn = Connection::get_defaultConnection();
	$Land = new Land($Conn);
	$Land->Title = $Title;
	$Land->Description = $Description;
	$Land->Currency = $Currency;
	$Land->Price = $Price;
	$Land->Location = $Location;
	$Land->Conditions=$Condition;
	$Land->Area = $Area;
    $Land->Size = 0;
    $Land->LandType = $LandType;
    $Land->WTO = $WTO;
	$Land->Category = $Category;
	$Land->Certificate = $Certificate;
	$Land->Marketing = $Marketing;
	$Land->Featured = $Featured;
	$Land->Active = $Active;
	$Land->MapImage = $FileName;
	if($FileName == $Stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $UploadFile);
		}
	$Land->Save();
	$Conn->Commit();

	header('location:Land.php');
} catch (Exception $e) {	
	include('Classes/ErrorHandler.php');
}
?>