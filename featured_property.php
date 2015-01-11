<?php 
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/NewProperty.php');
include_once('admin-panel/Classes/NewPropertyImage.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php'); 
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');

$category = isset($_GET['cat']) ? $_GET['cat'] : ''; 

?>

<div class="row featured_property">
					<div class="row title"><?php echo $LangFeaturedProperty ?></div>
					<div class="featured_property_container">
						
						<?php 
							if($category == 0){
								$Conn = Connection::get_DefaultConnection();
								$NewPropertys = NewProperty::LoadCollection($Conn, "Active = 1", "rand()");
								foreach ($NewPropertys as $NewProperty) {
									
									echo '<div>';
									echo '<a href="new_property.php?Id='.$NewProperty->get_Id().'">';
									$NewPropertyImages = NewPropertyImage::LoadCollection($Conn, "Active = 1 AND NewProperty =". $NewProperty->get_Id(), "", 1, 1);
									foreach ($NewPropertyImages as $NewPropertyImage) {
										echo '<div class="image"><img src="img.php?src=NewPropertys/'.$NewPropertyImage->ImageName.'&w=300" width="190" height="150"></div>';
									}
									echo '</a>';
									echo '<div class="featured_property_title">'.$NewProperty->Title.'</div>';
									echo '<div class="featured_property_detail">';
									echo '<div class="price">'.$NewProperty->Price.'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$NewProperty->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$NewProperty->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
					
									}
							}
							elseif($category == 1){
								$Conn = Connection::get_DefaultConnection();
								$SecondaryPropertys = SecondaryProperty::LoadCollection($Conn, "Active = 1 AND Featured = 1 AND Marketing = ".$UserId);
								foreach ($SecondaryPropertys as $SecondaryProperty) {
									
									echo '<div>';
									echo '<a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'">';
									$SecondaryPropertyImages = SecondaryPropertyImage::LoadCollection($Conn, "Active = 1 AND SecondaryProperty =". $SecondaryProperty->get_Id(), "", 1, 1);
									foreach ($SecondaryPropertyImages as $SecondaryPropertyImage) {
										echo '<div class="image"><img src="img.php?src=SecondaryPropertys/'.$SecondaryPropertyImage->ImageName.'&w=300" width="190" height="150"></div>';
									}
									echo '</a>';
									echo '<div class="featured_property_title">'.$SecondaryProperty->Title.'</div>';
									echo '<div class="featured_property_detail">';
									$Currency = Currency::GetObjectByKey($Conn, $SecondaryProperty->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$SecondaryProperty->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$SecondaryProperty->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
					
									}
							}
							elseif($category == 2){
								echo '<div>
							<img src="images/banners/banner01.jpg" width="190" height="150">
							<div class="featured_property_title">Royal Grande</div>
							<div class="featured_property_detail">
								<div class="price">Rp. 2.000.000.000</div>
								<div class="bedroom"><img src="images/bedroom_symbol.png"> 2</div>
								<div class="bathroom"><img src="images/bathroom_symbol.png"> 3</div>
							</div>
						</div><div>
							<img src="images/banners/banner01.jpg" width="190" height="150">
							<div class="featured_property_title">Royal Grande</div>
							<div class="featured_property_detail">
								<div class="price">Rp. 2.000.000.000</div>
								<div class="bedroom"><img src="images/bedroom_symbol.png"> 2</div>
								<div class="bathroom"><img src="images/bathroom_symbol.png"> 3</div>
							</div>
						</div><div>
							<img src="images/banners/banner01.jpg" width="190" height="150">
							<div class="featured_property_title">Royal Grande</div>
							<div class="featured_property_detail">
								<div class="price">Rp. 2.000.000.000</div>
								<div class="bedroom"><img src="images/bedroom_symbol.png"> 2</div>
								<div class="bathroom"><img src="images/bathroom_symbol.png"> 3</div>
							</div>
						</div><div>
							<img src="images/banners/banner01.jpg" width="190" height="150">
							<div class="featured_property_title">Royal Grande</div>
							<div class="featured_property_detail">
								<div class="price">Rp. 2.000.000.000</div>
								<div class="bedroom"><img src="images/bedroom_symbol.png"> 2</div>
								<div class="bathroom"><img src="images/bathroom_symbol.png"> 3</div>
							</div>
						</div>';
								$Conn = Connection::get_DefaultConnection();
								$RentPropertys = RentProperty::LoadCollection($Conn, "Active = 1 AND Featured = 1 AND Marketing = ".$UserId);
								foreach ($RentPropertys as $RentProperty) {
									
									echo '<div>';
									echo '<a href="rent_property.php?Id='.$RentProperty->get_Id().'">';
									$RentPropertyImages = RentPropertyImage::LoadCollection($Conn, "Active = 1 AND RentProperty =". $RentProperty->get_Id(), "", 1, 1);
									foreach ($RentPropertyImages as $RentPropertyImage) {
										echo '<div class="image"><img src="img.php?src=RentPropertys/'.$RentPropertyImage->ImageName.'&w=300" width="190" height="150"></div>';
									}
									echo '</a>';
									echo '<div class="featured_property_title">'.$RentProperty->Title.'</div>';
									echo '<div class="featured_property_detail">';
									$Currency = Currency::GetObjectByKey($Conn, $RentProperty->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($RentProperty->Price).'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$RentProperty->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$RentProperty->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
					
									}
							}
							elseif($category == 3){
								$Conn = Connection::get_DefaultConnection();
								$Lands = Land::LoadCollection($Conn, "Active = 1 AND Featured = 1 AND Marketing = ".$UserId);
								foreach ($Lands as $Land) {
									
									echo '<div>';
									echo '<a href="land_for_sale.php?Id='.$Land->get_Id().'">';
									$LandImages = LandImage::LoadCollection($Conn, "Active = 1 AND Land =". $Land->get_Id(), "", 1, 1);
									foreach ($LandImages as $LandImage) {
										echo '<div class="image"><img src="img.php?src=Lands/'.$LandImage->ImageName.'&w=300" width="190" height="150"></div>';
									}
									echo '</a>';
									echo '<div class="featured_property_title">'.$Land->Title.'</div>';
									echo '<div class="featured_property_detail">';
									$Currency = Currency::GetObjectByKey($Conn, $Land->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($Land->Price).'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$Land->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$Land->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
					
									}
							}
							elseif($category == 4){
								$Conn = Connection::get_DefaultConnection();
								$Query = "
								    SELECT * FROM 
                                    (SELECT SecondaryProperty.Id, Title, Price, Bathroom, Bedroom, Currency.Symbol, 'secondary_property' AS Category, 'SecondaryPropertys' AS ImagePath,  (SELECT ImageName FROM SecondaryPropertyImage WHERE SecondaryProperty = SecondaryProperty.Id LIMIT 0,1) AS ImageName
                                     FROM SecondaryProperty
                                     INNER JOIN Currency ON Currency.Id = SecondaryProperty.Currency
                                     WHERE SecondaryProperty.Active = 1 AND SecondaryProperty.Featured = 1
                            
                                     UNION ALL
                            
                                     SELECT RentProperty.Id, Title, Price, Bathroom, Bedroom, Currency.Symbol, 'rent_property' AS Category, 'RentPropertys' AS ImagePath, (SELECT ImageName FROM RentPropertyImage WHERE RentProperty = RentProperty.Id LIMIT 0,1) AS ImageName
                                     FROM RentProperty
                                     INNER JOIN Currency ON Currency.Id = RentProperty.Currency
                                     WHERE RentProperty.Active = 1 AND RentProperty.Featured = 1
                            
                                     UNION ALL
                            
                                     SELECT Land.Id, Title, Price, 0 AS Bathroom, 0 AS Bedroom, Currency.Symbol, 'land_for_sale' AS Category, 'Lands' AS ImagePath, (SELECT ImageName FROM LandImage WHERE Land = Land.Id LIMIT 0,1) AS ImageName
                                     FROM Land
                                     INNER JOIN Currency ON Currency.Id = Land.Currency
                                     WHERE Land.Active = 1 AND Land.Featured = 1
                                     
                                     ) AS tmpTable 
									ORDER BY RAND()
								";
								$Datas = mysqli_query($Conn, $Query);
								while ($Records = mysqli_fetch_array($Datas)){
									echo '<div>';
									echo '<a href='.$Records["Category"].'.php?Id='.$Records["Id"].'>';
									echo '<div class="image"><img src="img.php?src='.$Records["ImagePath"].'/'.$Records["ImageName"].'&w=300" width="190" height="150"></div>';
									echo '</a>';
									echo '<div class="featured_property_title">'.$Records["Title"].'</div>';
									echo '<div class="featured_property_detail">';
									echo '<div class="price">'.$Records["Symbol"].' '.number_format($Records["Price"]).'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$Records["Bedroom"].'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$Records["Bathroom"].'</div>';
									echo '</div>';
									echo '</div>';
								}


							}
						?>
						<!-- Static
						<div>
							<img src="images/banners/banner01.jpg" width="190" height="150">
							<div class="featured_property_title">Royal Grande</div>
							<div class="featured_property_detail">
								<div class="price">Rp. 2.000.000.000</div>
								<div class="bedroom"><img src="images/bedroom_symbol.png"> 2</div>
								<div class="bathroom"><img src="images/bathroom_symbol.png"> 3</div>
							</div>
						</div>
						-->
												
					</div>
				</div>