<?php
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/Facility.php');
include_once('admin-panel/Classes/NewProperty.php');
include_once('admin-panel/Classes/NewPropertyImage.php');
include_once('admin-panel/Classes/NewPropertyMarketing.php');
include_once('admin-panel/Classes/NewPropertyFacility.php');
include_once('admin-panel/Classes/User.php');

$NewPropertyId = $_GET['Id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<link rel="stylesheet" type="text/css" href="inc/skdslider/skdslider.css" />
		<link rel="stylesheet" type="text/css" href="inc/slick-master/slick/slick.css" />
        <link rel="icon" type="image/png" href="http://ipropertybatam.com/images/favicon.png">
    	<title>iPropertyBatam - Contact Us</title>
	</head>
	<body class="new_property">
	<div id="wrap">
		<div class="container">
			
			<!-- Header -->
			<?php include("header.php") ?>

			<div class="content">
				<div class="row fixed_banner">
					<img src="images/top_banner.png">
				</div>
				<div class="row">	
					<div class="left" style="width:74%;">
						<div class="banner skdslider">
							<ul>
								<?php 
									$Conn = Connection::get_DefaultConnection();
									$NewPropertyImages = NewPropertyImage::LoadCollection($Conn, "Active = 1 AND NewProperty = ".$NewPropertyId);
									foreach ($NewPropertyImages as $NewPropertyImage) {
										echo '<li><img src="images/NewPropertys/'.$NewPropertyImage->ImageName.'"></li>';
									}
								?>
							</ul>
						</div>

						<?php 
							$Conn = Connection::get_DefaultConnection();
							$NewProperty = NewProperty::GetObjectByKey($Conn, $NewPropertyId);

							echo '<div class="row property_detail">';
							echo '<div class="title">'.$NewProperty->Title.'</div>';
							$Currency = Currency::GetObjectByKey($Conn, $NewProperty->Currency);	
							echo '<div class="price">'.$Currency->Symbol.' '.number_format($NewProperty->MinPrice).' - '.$Currency->Symbol.' '.number_format($NewProperty->MaxPrice).'</div>';
							echo '<div class="category">NEW</div>';
							echo '</div>';

							echo '<div class="row property_detail_2">';
							echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$NewProperty->Bedroom.'</div>';
							echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$NewProperty->Bathroom.'</div>';
							echo '<div class="print" onclick="myFunction()"><img src="images/print_symbol.png"> Print this page</div>';
							echo '</div>';

							echo '<div class="row property_description">';
							echo '<div class="description">'.$NewProperty->Description.'</div>';
							echo '<div class="row">';
							echo '<div class="map" style="margin-top:0">';
							echo '<div class="title">Location Map</div>';
							echo '<img src="images/NewPropertys/'.$NewProperty->MapImage.'">';
							echo '</div>';
							echo '<div class="specification">';
							echo '<div class="title">Specifications</div>';

							if ($NewProperty->Foundation !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Foundation</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->Foundation.'</div>';
								echo '</div>';
							}

							if ($NewProperty->RoofFrame !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Roof Frame</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->RoofFrame.'</div>';
								echo '</div>';
							}			

							if ($NewProperty->Roof !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Roof</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->Roof.'</div>';
								echo '</div>';
							}		

							if ($NewProperty->Platfond !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Platfond</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->Platfond.'</div>';
								echo '</div>';
							}		

							if ($NewProperty->MainDoor !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Main Door</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->MainDoor.'</div>';
								echo '</div>';
							}

							if ($NewProperty->Floor !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Floor</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->Floor.'</div>';
								echo '</div>';
							}

							if ($NewProperty->Window !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Window</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->Window.'</div>';
								echo '</div>';
							}

							if ($NewProperty->Wall !== ""){
								echo '<div class="item">';
								echo '<div style="width: 35%">Wall</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 60%">'.$NewProperty->Wall.'</div>';
								echo '</div>';
							}

							echo '</div>';
							echo '</div>';

						?>
							<div class="row facility">
								<div class="title">Facilities</div>
								<div class="detail">
									<ul>
										<?php 
											$Conn = Connection::get_DefaultConnection();
											$NewPropertyFacilitys = NewPropertyFacility::LoadCollection($Conn, "NewProperty = ".$NewPropertyId);
											foreach ($NewPropertyFacilitys as $NewPropertyFacility) {
												$Facility = Facility::GetObjectByKey($Conn, $NewPropertyFacility->Facility);
												echo '<li>'.$Facility->Name.'</li>';
											}
										?>
										
									</ul>
								</div>
							</div>
						</div>
					</div> <!-- Close left -->

					<div class="right"  style="width:25%;">
						
						<div class="company">
							<div class="title">Marketing Office</div>
							<div class="image" style="float:left; height:120px; width:75px; margin-top:20px; margin-right:10px;"><img src="images/company_symbol.png" style="width:75px;"></div>
							<div class="name" style="float:left;">iPropertyBatam</div>
							<div class="address" style="float:left; font-size:12px;"><span style="height:40px; float:left"><img src="images/navigation_symbol.png"></span>Marina Business Centre <br>blok A no.07 <br>Batam - Nagoya</div>
							<div class="telp" style="float:left; font-size:12px;"><img src="images/telp_symbol.png">0778 - 428 889</div>
						</div>

						<div class="row marketing_title">Contact Person :</div>

						<?php 
							$Conn = Connection::get_DefaultConnection();
							$NewPropertyMarketings = NewPropertyMarketing::LoadCollection($Conn, "NewProperty = ".$NewPropertyId);
                            foreach($NewPropertyMarketings as $NewPropertyMarketing){
								$User = User::GetObjectByKey($Conn, $NewPropertyMarketing->Marketing);
								echo '<div class="property_marketing">';
								echo '<div class="image"><img src="images/Users/'.$User->ProfilePicture.'"></div>';		
								echo '<div class="name">'.$User->Name.'</div>';
								echo '<div class="telp"><img src="images/telp_symbol.png">'.$User->ContactNumber.'</div>';
								echo '<div class="email"><img src="images/email_symbol.png">'.$User->Email.'</div>';
								echo '</div>';
							}
						?>

						<?php 
							$_GET['cat'] = '0';
							@include("featured.php"); 
						?>

					</div> <!-- Close right -->

				</div> <!-- Close row -->

				<?php 
					$_GET['cat'] = '0';
					@include("related_property.php"); 
				?>

			</div> <!-- Close content -->
		</div> <!-- Close container -->
	</div> <!-- Close warp -->

	<!-- Footer -->
	<?php include("footer.php") ?>

	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="inc/skdslider/skdslider.js"></script>
	<script type="text/javascript" src="inc/slick-master/slick/slick.js"></script>
	<script type="text/javascript">

		jQuery(document).ready(function(){
			jQuery('.banner').skdslider({
				'delay':5000, 
				'fadeSpeed': 2000,
				'showNav':false,
				'showNextPrev':true,
				'showPlayButton':false,
				'autoStart':true
			});

			$('.related_property_container').slick({
				  slidesToShow: 4,
				  slidesToScroll: 1,
				  autoplay: true,
				  speed: 750
			});
		});

		function myFunction() {
		    window.print();
		}
	</script>

	</body>
</html>