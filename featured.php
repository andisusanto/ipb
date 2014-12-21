<?php 
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/Location.php');
include_once('admin-panel/Classes/NewProperty.php');
include_once('admin-panel/Classes/NewPropertyImage.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php'); 
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');

$category = isset($_GET['cat']) ? $_GET['cat'] : ''; 
$UserId = isset($_GET['userid']) ? ' AND Marketing = '.$_GET['userid'] : ''; 

?>

						<div class="featured_property">
							<div class="title">Featured Property</div>
							<div class="featured_property_container">
								
								<?php 
									if($category == 0){
										$Conn = Connection::get_DefaultConnection();
										$NewPropertys = NewProperty::LoadCollection($Conn, "Active = 1 AND Featured = 1", "", 1, 3);
										foreach ($NewPropertys as $NewProperty) {
											echo '<div class="featured_property_item">';
											$NewPropertyImages = NewPropertyImage::LoadCollection($Conn, "Active = 1 AND NewProperty =". $NewProperty->get_Id(), "", 1, 1);
											echo '<a href="new_property.php?Id='.$NewProperty->get_Id().'">';
											foreach ($NewPropertyImages as $NewPropertyImage) {
												echo '<div class="image"><img src="img.php?src=NewPropertys/'.$NewPropertyImage->ImageName.'&w=180"></div>';
											}
											echo "</a>";
											echo '<div class="red_tag">New Launching</div>';
											echo '<div class="title">'.$NewProperty->Title.'</div>';
											$Location = Location::GetObjectByKey($Conn, $NewProperty->Location);
											echo '<div class="subtitle">'.$Location->Name.'</div>';
											echo '<div class="detail">';
											echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$NewProperty->Bedroom.'</div>';
											echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$NewProperty->Bathroom.'</div>';
											echo '</div>';
											echo '</div>';
										}
									}
									elseif ($category == 1){
										$Conn = Connection::get_DefaultConnection();
										$SecondaryPropertys = SecondaryProperty::LoadCollection($Conn, "Active = 1 AND Featured = 1".$UserId, "", 1, 3);

										foreach ($SecondaryPropertys as $SecondaryProperty) {
											echo '<div class="featured_property_item">';
											$SecondaryPropertyImages = SecondaryPropertyImage::LoadCollection($Conn, "Active = 1 AND SecondaryProperty =". $SecondaryProperty->get_Id(), "", 1, 1);
											echo '<a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'">';
											foreach ($SecondaryPropertyImages as $SecondaryPropertyImage) {
												echo '<div class="image"><img src="img.php?src=SecondaryPropertys/'.$SecondaryPropertyImage->ImageName.'&w=180"></div>';
											}
											echo "</a>";
											echo '<div class="title">'.$SecondaryProperty->Title.'</div>';
											$Location = Location::GetObjectByKey($Conn, $SecondaryProperty->Location);
											echo '<div class="subtitle">'.$Location->Name.'</div>';
											$Currency = Currency::GetObjectByKey($Conn, $SecondaryProperty->Currency);
											echo '<div class="red_tag price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
											echo '<div class="detail">';
											echo '<div class="area">'.$SecondaryProperty->BuildingArea.'/'.$SecondaryProperty->LandArea.'</div>';
											echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$SecondaryProperty->Bedroom.'</div>';
											echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$SecondaryProperty->Bathroom.'</div>';
											echo '</div>';
											echo '</div>';
										}
									}
									elseif ($category == 2){
										$Conn = Connection::get_DefaultConnection();
										$RentPropertys = RentProperty::LoadCollection($Conn, "Active = 1 AND Featured = 1".$UserId, "", 1, 3);
										foreach ($RentPropertys as $RentProperty) {
											echo '<div class="featured_property_item">';
											$RentPropertyImages = RentPropertyImage::LoadCollection($Conn, "Active = 1 AND RentProperty =". $RentProperty->get_Id(), "", 1, 1);
											echo '<a href="rent_property.php?Id='.$RentProperty->get_Id().'">';
											foreach ($RentPropertyImages as $RentPropertyImage) {
												echo '<div class="image"><img src="img.php?src=RentPropertys/'.$RentPropertyImage->ImageName.'&w=180"></div>';
											}
											echo "</a>";
											echo '<div class="title">'.$RentProperty->Title.'</div>';
											$Location = Location::GetObjectByKey($Conn, $RentProperty->Location);
											echo '<div class="subtitle">'.$Location->Name.'</div>';
											echo '<div class="red_tag price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
											echo '<div class="detail">';
											echo '<div class="area">'.$RentProperty->BuildingArea.'/'.$RentProperty->LandArea.'</div>';
											echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$RentProperty->Bedroom.'</div>';
											echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$RentProperty->Bathroom.'</div>';
											echo '</div>';
											echo '</div>';
										}
									}
									elseif ($category == 3){
										$Conn = Connection::get_DefaultConnection();
										$Lands = Land::LoadCollection($Conn, "Active = 1 AND Featured = 1".$UserId, "", 1, 3);
										foreach ($Lands as $Land) {
											echo '<div class="featured_property_item">';
											$LandImages = LandImage::LoadCollection($Conn, "Active = 1 AND Land =". $Land->get_Id(), "", 1, 1);
											echo '<a href="land.php?Id='.$Land->get_Id().'">';
											foreach ($LandImages as $LandImage) {
												echo '<div class="image"><img src="img.php?src=Lands/'.$LandImage->ImageName.'&w=180"></div>';
											}
											echo "</a>";
											echo '<div class="title">'.$Land->Title.'</div>';
											$Location = Location::GetObjectByKey($Conn, $Land->Location);
											echo '<div class="subtitle">'.$Location->Name.'</div>';
											echo '<div class="red_tag price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
											echo '<div class="detail">';
											echo '<div class="area">'.$Land->BuildingArea.'/'.$Land->LandArea.'</div>';
											echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$Land->Bedroom.'</div>';
											echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$Land->Bathroom.'</div>';
											echo '</div>';
											echo '</div>';
										}
									}
								?>
								
								
							</div>
						</div>