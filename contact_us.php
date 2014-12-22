<?php
include_once('admin-panel/Classes/Advertisement.php');
include_once('admin-panel/Classes/User.php'); 
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php');

session_start();
include_once('languages/'.$_SESSION['Language'].'.php');
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
	<body class="contact_us">
	<div id="wrap">
		<div class="container">
			
			<!-- Header -->
			<?php include("header.php") ?>

			<div class="content">
				<div class="row fixed_banner">
					<img src="images/top_banner.png">
				</div>
				<div class="row">&nbsp;</div>
				<div class="row">	
					<div class="left" style="width:24%;">

						<div class="company">
							<div class="title">Kantor Pemasaran</div>
							<div class="image"><img src="images/company_symbol.png"></div>
							<div class="name">iPropertyBatam</div>
							<div class="address"><span style="height:40px; float:left"><img src="images/navigation_symbol.png"></span>Marina Business Centre <br>blok A no.07 <br>Batam - Nagoya</div>
							<div class="telp"><img src="images/telp_symbol.png">0778 - 428 889</div>
						</div>

						<div class="map row">
							<div><img src="images/no-image.png"></div>
						</div>
						<div class="advertisement">
							<?php
								$Conn = Connection::get_DefaultConnection();
								$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnContact = 1", "", 0, 2);
								$AdvCount = 0;
								foreach ($Advertisements as $Advertisement) {
									echo '<div class="row"><a href="'.$Advertisement->Link.'"><img src="images/Advertisements/'.$Advertisement->ImageName.'"></a></div>';
									$AdvCount++;
								}
								if ($AdvCount == 0){
									echo '<div class="row"><img src="img.php?src=Advertisements/Default.png&w=300"></div>';
									echo '<div class="row"><img src="img.php?src=Advertisements/Default.png&w=300"></div>';
								} 
								elseif($AdvCount == 1){
									echo '<div class="row"><img src="images/Advertisements/Default.png"></div>';
								}
							?>
						</div>

					</div> <!-- Close left -->

					<div class="right"  style="width:75%;">
						
						<?php 
							$Conn = Connection::get_DefaultConnection();
							$Users = User::LoadCollection($Conn, "UserType IN (1, 3)");
							foreach($Users as $User){
								echo '<div class="marketing">';
								echo '<div class="image"><img src="img.php?src=Users/'.$User->ProfilePicture.'&w=150"></div>';		
								echo '<div class="name">'.$User->Name.'</div>';
								echo '<div class="telp"><img src="images/telp_symbol.png">'.$User->ContactNumber.'</div>';
								echo '<div class="email"><img src="images/email_symbol.png">'.$User->Email.'</div>';
								echo '</div>';
							}
						?>
						<!-- Static
						<div class="marketing">
							<div class="image"><img src="images/banners/banner01.jpg"></div>
							<div class="name">Wilson</div>
							<div class="telp"><img src="images/telp_symbol.png">081991231812</div>
							<div class="email"><img src="images/email_symbol.png">wilson.young93@gmail.com</div>
						</div>
						-->
					</div> <!-- Close right -->

				</div> <!-- Close row -->

				<?php 
					$_GET['cat'] = '4';
					@include("related_property.php"); 
				?>

			</div> <!-- Close content -->
		</div> <!-- Close container -->
	</div> <!-- Close warp -->

	<!-- Footer -->
	<?php include("footer.php") ?>

	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="inc/slick-master/slick/slick.js"></script>
	<script type="text/javascript">
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
	</script>

	</body>
</html>