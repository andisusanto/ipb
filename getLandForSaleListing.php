<?php 
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

$Conn = Connection::get_DefaultConnection();
$Lands = Land::LoadCollection($Conn, "Active = 1", "Id DESC", $page_number, 6);
foreach($Lands as $Land){
									echo '<div class="property_listing_detail">';
									echo '<div class="title">'.$Land->Title.'</div>';
									$LandImages = LandImage::LoadCollection($Conn, "Active = 1 AND Land =". $Land->get_Id(), "", 1, 1);
									foreach ($LandImages as $LandImage) {
										echo '<div class="image"><a href="land_for_sale.php?Id='.$Land->get_Id().'"><img src="img.php?src=images/Lands/'.$LandImage->ImageName.'&w=300"></a></div>';
									}	
									$Currency = Currency::GetObjectByKey($Conn, $Land->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($Land->Price).'</div>';
									echo '<div class="description">'.$Land->Description.'</div>';
									echo '<div class="more_detail_link"><a href="land_for_sale.php?Id='.$Land->get_Id().'">More Detail</a></div>';
									echo '<div class="detail">';
									echo '<div class="area">'.$Land->Area.'</div>';
									echo '</div>';
									echo '</div>';
								}			
?>