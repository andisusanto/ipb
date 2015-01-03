<?php
include_once('admin-panel/Classes/Currency.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php');
include_once('admin-panel/Classes/User.php');
include_once('admin-panel/Classes/Advertisement.php');

include('checklanguage.php');
$SecondaryPropertyId = $_GET['Id'];
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
    	<title>iPropertyBatam - Secondary Property</title>
	</head>
	<body class="secondary_property">
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
									$SecondaryPropertyImages = SecondaryPropertyImage::LoadCollection($Conn, "Active = 1 AND SecondaryProperty = ".$SecondaryPropertyId);
									foreach ($SecondaryPropertyImages as $SecondaryPropertyImage) {
										echo '<li><img src="img.php?src=SecondaryPropertys/'.$SecondaryPropertyImage->ImageName.'&w=1000"></li>';
									}
								?>
							</ul>
						</div>

						<?php 
							$Conn = Connection::get_DefaultConnection();
							$SecondaryProperty = SecondaryProperty::GetObjectByKey($Conn, $SecondaryPropertyId);
							echo '<div class="row property_detail">';
							echo '<div class="title">'.$SecondaryProperty->Title.'</div>';
							$Currency = Currency::GetObjectByKey($Conn, $SecondaryProperty->Currency);	
							echo '<div class="price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
							echo '<div class="category">Secondary Property</div>';
							echo '</div>';

							echo '<div class="row property_detail_2">';
							echo '<div class="area"><img src="images/area_symbol.png"> '.$SecondaryProperty->BuildingArea.' / '.$SecondaryProperty->LandArea.'</div>';
							echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$SecondaryProperty->Bedroom.'</div>';
							echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$SecondaryProperty->Bathroom.'</div>';
							echo '<div class="print" onclick="myFunction()"><img src="images/print_symbol.png"> Print this page</div>';
							echo '</div>';

							echo '<div class="row property_description">';
							echo '<div class="description">'.$SecondaryProperty->Description.'</div>';
							echo '<div class="row">';
							echo '<div class="specification">';
							echo '<div class="title">Specifications</div>';

							if ($SecondaryProperty->BuildingArea !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Building Area</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$SecondaryProperty->BuildingArea.'</div>';
								echo '</div>';
							}

							if ($SecondaryProperty->LandArea !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Land Area</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$SecondaryProperty->LandArea.'</div>';
								echo '</div>';
							}			

							if ($SecondaryProperty->Bedroom !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Bedroom</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$SecondaryProperty->Bedroom.'</div>';
								echo '</div>';
							}		

							if ($SecondaryProperty->Bathroom !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Bathroom</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$SecondaryProperty->Bathroom.'</div>';
								echo '</div>';
							}		

							if ($SecondaryProperty->FunitureIncluded == 1){
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

							if ($SecondaryProperty->Certificate !== ""){
								echo '<div class="item">';
								echo '<div style="width: 40%">Certificate</div>';
								echo '<div style="width: 5%"> : </div>';
								echo '<div style="width: 55%">'.$SecondaryProperty->Certificate.'</div>';
								echo '</div>';
							}

							echo '</div>';
							echo '<div  style="width:50%; float:right" >';
							echo '<div class="company">';
							echo '<div class="title">Marketing Office</div>';
							echo '<div class="image" style="float:left; height:120px; width:75px; margin-top:20px; margin-right:10px;"><img src="images/company_symbol.png" style="width:75px;"></div>';
							echo '<div class="name" style="float:left;">iPropertyBatam</div>';
							echo '<div class="address" style="float:left; "><span style="height:40px; float:left"><img src="images/navigation_symbol.png"></span>Marina Business Centre blok A no.07 <br>Batam - Nagoya</div>';
							echo '<div class="telp" style="float:left; "><img src="images/telp_symbol.png">0778 - 428 889</div>';
							echo '</div>';

							echo '<div class="row marketing_title">Contact Person :</div>';

							echo '<div class="property_marketing">';
							$User = User::GetObjectByKey($Conn, $SecondaryProperty->Marketing);	
							$UserId = $User->get_Id();
							echo '<div class="image"><img src="img.php?src=Users/'.$User->ProfilePicture.'&w=150"></div>';
							echo '<div class="name">'.$User->Name.'</div>';
							echo '<div class="telp"><img src="images/telp_symbol.png">'.$User->ContactNumber.'</div>';
							echo '<div class="email"><img src="images/email_symbol.png">'.$User->Email.'</div>';
							echo '</div>';
							echo '</div>';
													
							
							echo '</div>';

						?>
						<!-- static
						<div class="row property_detail">
							<div class="title">Nicco Residence</div>
							<div class="price">Rp. 2.000.000.000</div>
							<div class="category">NEW</div>
						</div>

						<div class="row property_detail_2">
							<div class="area"><img src="images/area_symbol.png"> 100 / 200</div>
							<div class="bedroom"><img src="images/bedroom_symbol.png"> 2 - 3</div>
							<div class="bathroom"><img src="images/bathroom_symbol.png">  1 - 2</div>
							<div class="print" onclick="myFunction()"><img src="images/print_symbol.png"> Print this page</div>
						</div>

						<div class="row property_description">
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetu orem ipsum dolor sit amet, consectetu adipiscing elit, sed diam nonummy nibh euismod tincidunt ut 
	laoreet doloreadipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet doloresit amet, consectetu adipiscing elit, sed diam nonum
	my nibh euismod tincidunt ut laoreet doloreadipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore</p>
							</div>

							<div class="row">
								
								<div class="specification" style="width:45%; margin-right:20px;">
									<div class="title">Specifications</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Rangka Atap</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
									<div class="item">
										<div style="width: 35%">Faundation</div>
										<div style="width: 5%"> : </div>
										<div style="width: 60%">Beton Bertulang</div>
									</div>
								</div>

								<div  style="width:50%; float:left" >
									<div class="company">
										<div class="title">Kantor Pemasaran</div>
										<div class="image" style="float:left; height:120px; width:75px; margin-top:20px; margin-right:10px;"><img src="images/company_symbol.png" style="width:75px;"></div>
										<div class="name" style="float:left;">iPropertyBatam</div>
										<div class="address" style="float:left; "><span style="height:40px; float:left"><img src="images/navigation_symbol.png"></span>Marina Business Centre blok A no.07 <br>Batam - Nagoya</div>
										<div class="telp" style="float:left; "><img src="images/telp_symbol.png">0778 - 428 889</div>
									</div>

									<div class="row marketing_title">Contact Person :</div>

									<div class="property_marketing">
										<div class="image"><img src="images/banners/banner01.jpg"></div>
										<div class="name">Wilson</div>
										<div class="telp"><img src="images/telp_symbol.png">081991231812</div>
										<div class="email"><img src="images/email_symbol.png">wilson.young93@gmail.com</div>
									</div>
								</div>

							</div>
							-->
							

						</div>
					</div> <!-- Close left -->

					<div class="right"  style="width:25%;">
						
						<div class="kpr">
							<div class="title">Kredit Pemilikan Rumah</div>
							<div class="container">
								<?php 
									$PropertyPrice = $SecondaryProperty->Price;
									$Deposit = $SecondaryProperty->Deposit;
									$EstimatedInterestRate = $SecondaryProperty->EstimatedInterestRate;
									$Periods = $SecondaryProperty->Periods;
									$DepositAmount = $PropertyPrice * ($Deposit/100);
									$LoanAmount = $PropertyPrice - $DepositAmount;
									$Rate = ($EstimatedInterestRate * $Periods) / 1.7;
									$TotalMonths = $Periods * 12;
									$GrandTotalKPR = ($LoanAmount + ($LoanAmount * ($Rate/100)))/$TotalMonths
								?>
								<div class="label">Property Price</div>
								<div class="component"><input type="text" value="<?php echo $Currency->Symbol.' '.number_format($PropertyPrice) ?>" disabled style="width:95%"/></div>
								<div class="label">Down Payment</div>
								<div class="component"><input type="text" value="<?php echo $Currency->Symbol.' '.number_format($DepositAmount) ?>" disabled /> </div>
								<div class="label">Time Period</div>
								<div class="component"><input type="text" value="<?php echo $Periods ?>" disabled /> years</div>
								<div class="label">Rate</div>
								<div class="component"><input type="text" value="<?php echo $EstimatedInterestRate ?>" disabled /> % per year</div>
								<div class="label">Monthly Payments</div>

								<div class="total"><?php echo $Currency->Symbol.' '.number_format($GrandTotalKPR) ?></div>
								<input type="button" value="Calculate" />
							</div>
						</div>
					
						<?php 
							//$_GET['cat'] = '1';
							//$_GET['userid'] = $UserId;
							//@include("featured.php"); 
						?>
						<div class="advertisement">
							<?php
								$Conn = Connection::get_DefaultConnection();
								$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnSecondaryPropertyListing = 1", "", 1, 2);
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
					$_GET['cat'] = '1';
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