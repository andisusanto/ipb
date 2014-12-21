<?php
include_once('admin-panel/Classes/Advertisement.php');
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php');
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');

$Category = 1;
$Location = 2;
$Bedroom = 3;
$Bathroom = 4;
$Currency = 5;
$MinPrice = 6;
$MaxPrice = 7;

if ($Category == 1){ $TableName = "SecondaryProperty"; }
elseif ($Category == 2){ $TableName = "RentProperty"; }
elseif ($Category == 3){ $TableName = "Land"; }

$Filter = "Location = ".$Location." AND Bedroom = ".$Bedroom." AND Bathroom = ".$Bathroom." AND Currency = ".$Currency." Price BETWEEN ".$MinPrice." AND ".$MaxPrice." ";

$Conn = Connection::get_DefaultConnection();
							
							$results = Count($TableName::LoadCollection($Conn, "Active = 1"));

							echo $TableName .= "a"
?>
