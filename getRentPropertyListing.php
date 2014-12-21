<?php 
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

$Conn = Connection::get_DefaultConnection();
$RentPropertys = RentProperty::LoadCollection($Conn, "Active = 1", "Id DESC", $page_number, 6);
foreach($RentPropertys as $RentProperty){
									echo '<div class="property_listing_detail">';
									echo '<div class="title">'.$RentProperty->Title.'</div>';
									$RentPropertyImages = RentPropertyImage::LoadCollection($Conn, "Active = 1 AND RentProperty =". $RentProperty->get_Id(), "", 1, 1);
									foreach ($RentPropertyImages as $RentPropertyImage) {
										echo '<div class="image"><a href="rent_property.php?Id='.$RentProperty->get_Id().'"><img src="img.php?src=RentPropertys/'.$RentPropertyImage->ImageName.'&w=300"></a></div>';
									}	
									$Currency = Currency::GetObjectByKey($Conn, $RentProperty->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($RentProperty->Price).'</div>';
									echo '<div class="description">'.$RentProperty->Description.'</div>';
									echo '<div class="more_detail_link"><a href="rent_property.php?Id='.$RentProperty->get_Id().'">More Detail</a></div>';
									echo '<div class="detail">';
									echo '<div class="area">'.$RentProperty->BuildingArea.'/'.$RentProperty->LandArea.'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$RentProperty->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$RentProperty->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
											
}				
?>