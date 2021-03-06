<?php
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');
include_once('admin-panel/Classes/User.php');

include('checklanguage.php');
$LandId = $_GET['Id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Kami Menerima Titipan Jual Beli Sewa Property Batam Bebas Biaya Administrasi, Biaya Iklan dan Promosi! Hubungi: 0778-428 889 Email: Marketing@ipropertybatam.com">
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<link rel="stylesheet" type="text/css" href="inc/skdslider/skdslider.css" />
		<link rel="stylesheet" type="text/css" href="inc/slick-master/slick/slick.css" />
        <link rel="icon" type="image/png" href="http://ipropertybatam.com/images/favicon.png">
    	<title>iPropertyBatam - Land For Sale</title>
	</head>
	<body class="land_for_sale">
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
									$LandImages = LandImage::LoadCollection($Conn, "Active = 1 AND Land = ".$LandId);
									foreach ($LandImages as $LandImage) {
										echo '<li><img src="img.php?src=Lands/'.$LandImage->ImageName.'&w=1000"></li>';
									}
								?>
							</ul>
						</div>

						<?php 
							$Conn = Connection::get_DefaultConnection();
							$Land = Land::GetObjectByKey($Conn, $LandId);
							echo '<div class="row property_detail">';
							echo '<div class="title">'.$Land->Title.'</div>';
							$Currency = Currency::GetObjectByKey($Conn, $Land->Currency);	
							echo '<div class="price">'.$Currency->Symbol.' '.number_format($Land->Price).'/Years</div>';
							echo '<div class="category">Land For Sale</div>';
							echo '</div>';

							echo '<div class="row property_detail_2">';
							echo '<div class="area"><img src="images/area_symbol.png"> '.$Land->Area.'</div>';
							echo '<div class="print" onclick="myFunction()"><img src="images/print_symbol.png"> Print this page</div>';
							echo '</div>';

							echo '<div class="row property_description">';
							echo '<div class="description">'.$Land->Description.'</div>';
							echo '<div class="row">';
							echo '<div class="map">';
							echo '<div class="title">Location Map</div>';
							echo '<img src="img.php?src=Lands/'.$Land->MapImage.'&w=700">';
							echo '</div>';
							echo '<div class="specification">';
							echo '<div class="title">Specifications</div>';

							if ($Land->Category !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Category</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->Category.'</div>';
								echo '</div>';
							}

							if ($Land->Location !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Location</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->Location.'</div>';
								echo '</div>';
							}			

							if ($Land->LandType !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Land Type</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->LandType.'</div>';
								echo '</div>';
							}		

							if ($Land->Area !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Area</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->Area.' meter</div>';
								echo '</div>';
							}		

							if ($Land->Condition !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Condition</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->Condition.'</div>';
								echo '</div>';
							}
							
							if ($Land->Certificate !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Certificate</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->Certificate.'</div>';
								echo '</div>';
							}

							if ($Land->WTO !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">WTO</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$Land->WTO.' years</div>';
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
							$User = User::GetObjectByKey($Conn, $Land->Marketing);	
							$UserId = $User->get_Id();
							echo '<div class="image"><img src="img.php?src=Users/'.$User->ProfilePicture.'&w=150"></div>';
							echo '<div class="name">'.$User->Name.'</div>';
							echo '<div class="telp"><img src="images/telp_symbol.png">'.$User->ContactNumber.'</div>';
							echo '<div class="email"><img src="images/email_symbol.png">'.$User->Email.'</div>';
							echo '</div>';
						?>
					
						<?php 
							//$_GET['cat'] = '3';
							//$_GET['userid'] = $UserId;
							//@include("featured.php"); 
						?>
						<div class="advertisement">
							<?php
								$Conn = Connection::get_DefaultConnection();
								$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnLandForSaleListing = 1", "", 1, 2);
								$AdvCount = 0;
								foreach ($Advertisements as $Advertisement) {
									echo '<div class="row"><a href="'.$Advertisement->Link.'"><img src="images/Advertisements/'.$Advertisement->ImageName.'"></a></div>';
									$AdvCount++;
								}
								if ($AdvCount == 0){
									echo '<div class="row"><img src="images/Advertisements/Default.png"></div>';
									echo '<div class="row"><img src="images/Advertisements/Default.png"></div>';
								} 
								elseif($AdvCount == 1){
									echo '<div class="row"><img src="images/Advertisements/Default.png"></div>';
								}
							?>
							
						</div>
					</div> <!-- Close right -->

				</div> <!-- Close row -->

				<?php 
					$_GET['cat'] = '3';
					@include("featured_property.php"); 
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

			$('.featured_property_container').slick({
				  slidesToShow: 4,
				  slidesToScroll: 1,
				  autoplay: true,
				  speed: 750
			});
			$(".btnlanguage").click(function(){
				$("input[name=Language]").val($(this).attr('name'));
				$("input[name=ReturnURL]").val(document.URL);
				$("#frmLanguage").submit();
			});
		});


		function myFunction() {
		    window.print();
		}
	</script>

	</body>
</html>