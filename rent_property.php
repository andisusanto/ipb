<?php
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');
include_once('admin-panel/Classes/User.php');

$RentPropertyId = $_GET['Id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<link rel="stylesheet" type="text/css" href="inc/skdslider/skdslider.css" />
		<link rel="stylesheet" type="text/css" href="inc/slick-master/slick/slick.css" />
        <link rel="icon" type="image/png" href="http://ipropertybatam.com/images/favicon.png">
    	<title>iPropertyBatam - Rent Property</title>
	</head>
	<body class="rent_property">
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
									$RentPropertyImages = RentPropertyImage::LoadCollection($Conn, "Active = 1 AND RentProperty = ".$RentPropertyId);
									foreach ($RentPropertyImages as $RentPropertyImage) {
										echo '<li><img src="img.php?src=RentPropertys/'.$RentPropertyImage->ImageName.'&w=1000"></li>';
									}
								?>
							</ul>
						</div>

						<?php 
							$Conn = Connection::get_DefaultConnection();
							$RentProperty = RentProperty::GetObjectByKey($Conn, $RentPropertyId);
							echo '<div class="row property_detail">';
							echo '<div class="title">'.$RentProperty->Title.'</div>';
							$Currency = Currency::GetObjectByKey($Conn, $RentProperty->Currency);	
							echo '<div class="price">'.$Currency->Symbol.' '.number_format($RentProperty->Price).'/Years</div>';
							echo '<div class="category">Rental</div>';
							echo '</div>';

							echo '<div class="row property_detail_2">';
							echo '<div class="area"><img src="images/area_symbol.png"> '.$RentProperty->BuildingArea.' / '.$RentProperty->LandArea.'</div>';
							echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$RentProperty->Bedroom.'</div>';
							echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$RentProperty->Bathroom.'</div>';
							echo '<div class="print" onclick="myFunction()"><img src="images/print_symbol.png"> Print this page</div>';
							echo '</div>';

							echo '<div class="row property_description">';
							echo '<div class="description">'.$RentProperty->Description.'</div>';
							echo '<div class="row">';
							echo '<div class="map">';
							echo '<div class="title">Location Map</div>';
							echo '<img src="img.php?src=RentPropertys/'.$RentProperty->MapImage.'&w=700">';
							echo '</div>';
							echo '<div class="specification">';
							echo '<div class="title">Specifications</div>';

							if ($RentProperty->BuildingArea !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Building Area</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$RentProperty->BuildingArea.'</div>';
								echo '</div>';
							}

							if ($RentProperty->LandArea !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Land Area</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$RentProperty->LandArea.'</div>';
								echo '</div>';
							}			

							if ($RentProperty->Bedroom !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Bedroom</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$RentProperty->Bedroom.'</div>';
								echo '</div>';
							}		

							if ($RentProperty->Bathroom !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Bathroom</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$RentProperty->Bathroom.'</div>';
								echo '</div>';
							}		

							if ($RentProperty->FunitureIncluded == 1){
								echo '<div class="item">';
								echo '<div style="width: 40%">Funiture Included</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">Yes</div>';
								echo '</div>';
							}else{
								echo '<div class="item">';
								echo '<div style="width: 40%">Funiture Included</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">No</div>';
								echo '</div>';
							}

							if ($RentProperty->MinimumContract !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Minimum Contract</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$RentProperty->MinimumContract.' Months</div>';
								echo '</div>';
							}
																		
							echo '</div>';
							echo '</div>';

						?>

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
							echo '<div class="property_marketing">';
							$User = User::GetObjectByKey($Conn, $RentProperty->Marketing);	
							$UserId = $User->get_Id();
							echo '<div class="image"><img src="img.php?src=Users/'.$User->ProfilePicture.'&w=150"></div>';
							echo '<div class="name">'.$User->Name.'</div>';
							echo '<div class="telp"><img src="images/telp_symbol.png">'.$User->ContactNumber.'</div>';
							echo '<div class="email"><img src="images/email_symbol.png">'.$User->Email.'</div>';
							echo '</div>';
						?>

						<?php 
							$_GET['cat'] = '2';
							$_GET['userid'] = $UserId;
							@include("featured.php"); 
						?>

					</div> <!-- Close right -->

				</div> <!-- Close row -->

				<?php 
					$_GET['cat'] = '2';
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