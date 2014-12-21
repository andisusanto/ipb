<?php 
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/NewProperty.php');
include_once('admin-panel/Classes/NewPropertyImage.php');

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

								$Conn = Connection::get_DefaultConnection();
								$NewPropertys = NewProperty::LoadCollection($Conn, "Active = 1", "Id DESC", $page_number, 6);

								foreach($NewPropertys as $NewProperty){
									echo '<div class="property_listing_detail">';
									echo '<div class="title">'.$NewProperty->Title.'</div>';
									$NewPropertyImages = NewPropertyImage::LoadCollection($Conn, "Active = 1 AND NewProperty =". $NewProperty->get_Id(), "", 1, 1);
									foreach ($NewPropertyImages as $NewPropertyImage) {
										echo '<div class="image"><a href="new_property.php?Id='.$NewProperty->get_Id().'"><img src="img.php?src=NewPropertys/'.$NewPropertyImage->ImageName.'&w=300"></a></div>';
									}	
									$Currency = Currency::GetObjectByKey($Conn, $NewProperty->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($NewProperty->MinPrice).' - '.$Currency->Symbol.' '.number_format($NewProperty->MaxPrice).'</div>';
									echo '<div class="description">'.$NewProperty->Description.'</div>';
									echo '<div class="more_detail_link"><a href="new_property.php?Id='.$NewProperty->get_Id().'">More Detail</a></div>';
									echo '<div class="detail">';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$NewProperty->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$NewProperty->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
								}								


?>


								
					