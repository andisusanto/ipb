<?php 
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php');

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

$Conn = Connection::get_DefaultConnection();
$SecondaryPropertys = SecondaryProperty::LoadCollection($Conn, "Active = 1", "Id DESC", $page_number, 6);
foreach($SecondaryPropertys as $SecondaryProperty){
	echo '<div class="property_listing_detail">';
	echo '<div class="title">'.$SecondaryProperty->Title.'</div>';
	$SecondaryPropertyImages = SecondaryPropertyImage::LoadCollection($Conn, "Active = 1 AND SecondaryProperty =". $SecondaryProperty->get_Id(), "", 1, 1);
	foreach ($SecondaryPropertyImages as $SecondaryPropertyImage) {
		echo '<div class="image"><a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'"><img src="img.php?src=SecondaryPropertys/'.$SecondaryPropertyImage->ImageName.'&w=300"></a></div>';
	}	
	$Currency = Currency::GetObjectByKey($Conn, $SecondaryProperty->Currency);	
	echo '<div class="price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
	echo '<div class="description">'.$SecondaryProperty->Description.'</div>';
	echo '<div class="more_detail_link"><a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'">More Detail</a></div>';
	echo '<div class="detail">';
	echo '<div class="area">'.$SecondaryProperty->BuildingArea.'/'.$SecondaryProperty->LandArea.'</div>';
	echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$SecondaryProperty->Bedroom.'</div>';
	echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$SecondaryProperty->Bathroom.'</div>';
	echo '</div>';
	echo '</div>';
}				
?>