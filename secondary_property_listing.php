<?php
include_once('admin-panel/Classes/Advertisement.php');
include_once('admin-panel/Classes/Currency.php'); 
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
    	<title>iPropertyBatam - Secondary Property</title>
	</head>
	<body class="secondary_property">
	<div id="wrap">
		<div class="container">
			
			<!-- Header -->
			<?php include("header.php") ?>

			<div class="content">
				<div class="row">	
					<div class="left" style="width:24%;">
						<!-- serach Form -->
						<?php 
							$_GET['cat'] = '1';
							@include("search_form.php"); 
						?>

						<div class="row">&nbsp;</div> <!-- empty row space -->

						<?php 
							$_GET['cat'] = '1';
							@include("featured.php"); 
						?>

						<div class="advertisement">
							<?php
								$Conn = Connection::get_DefaultConnection();
								$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnSecondaryPropertyListing = 1", "", 1, 2);
								$AdvCount = 0;
								foreach ($Advertisements as $Advertisement) {
									echo '<div class="row"><a href="'.$Advertisement->Link.'"><img src="img.php?src=Advertisements/'.$Advertisement->ImageName.'&w=300"></a></div>';
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

					</div> <!-- Close left -->

					<div class="right property_listing"  style="width:75%;">
						<div class="title">Property Listing</div>
						<div class="property_listing_container" id="results">
							
							<?php 
								/*$Conn = Connection::get_DefaultConnection();
								$SecondaryPropertys = SecondaryProperty::LoadCollection($Conn, "Active = 1", "Id DESC", 0, 6);

								foreach($SecondaryPropertys as $SecondaryProperty){
									echo '<div class="property_listing_detail">';
									echo '<div class="title">'.$SecondaryProperty->Title.'</div>';
									$SecondaryPropertyImages = SecondaryPropertyImage::LoadCollection($Conn, "Active = 1 AND SecondaryProperty =". $SecondaryProperty->get_Id(), "", 0, 1);
									foreach ($SecondaryPropertyImages as $SecondaryPropertyImage) {
										echo '<div class="image"><img src="images/SecondaryPropertys/'.$SecondaryPropertyImage->ImageName.'"></div>';
									}	
									$Currency = Currency::GetObjectByKey($Conn, $SecondaryProperty->Currency);	
									echo '<div class="price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
									echo '<div class="description">'.$SecondaryProperty->Description.'</div>';
									echo '<div class="more_detail_link"><a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'">More Detail</a></div>';
									echo '<div class="detail">';
									echo '<div class="area">'.$SecondaryProperty->BuildingArea.'/'.$SecondaryProperty->LandArea.'</div>';
									echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$SecondaryProperty->Bedroom.'</div>';
									echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$SecondaryProperty->Bathroom.'</div>';
									echo '</div>';
									echo '</div>';
								}*/



							?>
							<!-- Static
							<div class="property_listing_detail">
								<div class="title">Villa Panbil</div>
								<div class="image"><img src="images/banners/banner01.jpg"></div>
								<div class="price">Rp. 1.000.000.000</div>
								<div class="description">Lorem ipsum dolor sit amet, consectetu orem ipsum dolor sit amet, consectetu adipiscing elit, sed diam nonummy nibh euismod tincidunt aoreet doloreadipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore</div>
								<div class="more_detail_link"><a href="#">More Detail</a></div>
								<div class="detail">
									<div class="area"><img src="images/area_symbol.png"> 100 - 400 m</div>
									<div class="bedroom"><img src="images/bedroom_symbol.png"> 1 -2</div>
									<div class="bathroom"><img src="images/bathroom_symbol.png"> 3 - 4</div>
								</div>
							</div>
							-->
						</div> <!-- Close property_listing_container -->
						<?php 
						$results = Count(SecondaryProperty::LoadCollection($Conn, "Active = 1"));
								$item_per_page = 6;
								$pages = ceil($results/$item_per_page);	
								
								//create pagination
								if($pages >= 1)
								{
									$paginate	= '';
									$paginate	.= '<ul class="paginate row">';
									for($i = 1; $i<=$pages; $i++)
									{
										$paginate .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
									}
									$paginate .= '</ul>';
								}
echo $paginate;
								?>
					</div> <!-- Close right -->

				</div> <!-- Close row -->
			</div> <!-- Close content -->
		</div> <!-- Close container -->
	</div> <!-- Close warp -->

	<!-- Footer -->
	<?php include("footer.php") ?>

	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#results").load("getSecondaryPropertyListing.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			
			$(".paginate_click").click(function (e) {
				var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
				var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
				$('.paginate_click').removeClass('active'); //remove any active class
				$("#results").load("getSecondaryPropertyListing.php", {'page':(page_num)}, function(){

				});
				$(this).addClass('active'); //add active class to currently clicked element (style purpose)
				return false; //prevent going to herf link
			});	

			$(".btnlanguage").click(function(){
				$("input[name=Language]").val($(this).attr('name'));
				$("input[name=ReturnURL]").val(document.URL);
				$("#frmLanguage").submit();
			});
			
		});
	</script>

	</body>
</html>