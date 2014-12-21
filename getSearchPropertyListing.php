<?php 
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php');
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');

$Category = $_POST['cat'];
$Filter = $_POST['filter'];

if ($Category == 1){$TableName = "SecondaryProperty"; $ParentName = "SecondaryProperty";  $FileName = "secondary_property"; }
elseif ($Category == 2){ $TableName = "RentProperty"; $ParentName = "RentProperty" ;$FileName = "rent_property"; }
elseif ($Category == 3){ $TableName = "Land"; $ParentName = "Land"; $FileName = "land_for_sale"; }
$ImageTableName = $TableName . "Image";


$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

$Conn = Connection::get_DefaultConnection();
$Records = $TableName::LoadCollection($Conn, $Filter, "Id DESC", $page_number, 6);
foreach($Records as $TableName){
	echo '<a href="'.$FileName.'.php?Id='.$TableName->get_Id().'">';
	echo '<div class="property_listing_detail">';
	echo '<div class="title">'.$TableName->get_Id().'</div>';
	$ImageRecords = $ImageTableName::LoadCollection($Conn, "Active = 1 AND ". $ParentName ." = ". $TableName->get_Id(), "", 1, 1);
	foreach ($ImageRecords as $ImageTableName) {
		echo '<div class="image"><img src="img.php?src='.$ParentName.'s/'.$ImageTableName->ImageName.'&w=300"></div>';
	}	
	$Currency = Currency::GetObjectByKey($Conn, $TableName->Currency);	
	echo '<div class="price">'.$Currency->Symbol.' '.number_format($TableName->Price).'</div>';
	echo '<div class="description">'.$TableName->Description.'</div>';
	echo '<div class="more_detail_link"><a href="'.$FileName.'.php?Id='.$TableName->get_Id().'">More Detail</a></div>';
	echo '<div class="detail">';
	if ($Category == 3){
		echo '<div class="area">'.$TableName->Area.'</div>';
	}else{
		echo '<div class="area">'.$TableName->BuildingArea.'/'.$TableName->LandArea.'</div>';
		echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$TableName->Bedroom.'</div>';
		echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$TableName->Bathroom.'</div>';
	}
	
	echo '</div>';
	echo '</div>';
	echo '</a>';
}				
?>