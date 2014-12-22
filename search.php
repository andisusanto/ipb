<?php
include_once('admin-panel/Classes/Advertisement.php');
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/Land.php');
include_once('admin-panel/Classes/LandImage.php');
include_once('admin-panel/Classes/SecondaryProperty.php');
include_once('admin-panel/Classes/SecondaryPropertyImage.php');
include_once('admin-panel/Classes/RentProperty.php');
include_once('admin-panel/Classes/RentPropertyImage.php');

include('checklanguage.php');

$Category = $_POST['Category'];
$Location = $_POST['Location'];
$Bedroom = $_POST['Bedroom'];
$Bathroom = $_POST['Bathroom'];
$Currency = $_POST['Currency'];
$MinPrice = $_POST['MinPrice'];
$MaxPrice = $_POST['MaxPrice'];

if ($Category == 1){ $TableName = "SecondaryProperty"; $FileName = "secondary_property"; }
elseif ($Category == 2){ $TableName = "RentProperty"; $FileName = "rent_property"; }
elseif ($Category == 3){ $TableName = "Land"; $FileName = "land_for_sale"; }

$Filter = "Active = 1 AND Bathroom = ".$Bathroom." AND Currency = ".$Currency." AND Price BETWEEN ".$MinPrice." AND ".$MaxPrice." ";
if ($Location !== 0){$Filter .= " AND Location = ".$Location;}
if ($Bedroom !== 0){$Filter .= " AND Bedroom = ".$Bedroom;}
if ($Bathroom !== 0){$Filter .= " AND Bathroom = ".$Bathroom;}
if ($MinPrice !== 0 && $MaxPrice !== 0){$Filter .= " AND Price BETWEEN ".$MinPrice." AND ".$MaxPrice;}
	else {
		if ($MinPrice == 0){$Filter .= " AND Price <= ".$MaxPrice; }
		elseif ($MaxPrice == 0){$Filter .= "AND Price >= ".$MinPrice;}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<link rel="stylesheet" type="text/css" href="inc/skdslider/skdslider.css" />
		<link rel="stylesheet" type="text/css" href="inc/slick-master/slick/slick.css" />
        <link rel="icon" type="image/png" href="http://ipropertybatam.com/images/favicon.png">
    	<title>iPropertyBatam - Search</title>
	</head>
	<body>
	<div id="wrap">
		<div class="container">
			
			<!-- Header -->
			<?php include("header.php") ?>

			<div class="content">
				<div class="row">	
					<div class="left" style="width:24%;">
						<!-- serach Form -->
						<?php 
							include("search_form.php"); 
						?>

						<div class="row">&nbsp;</div> <!-- empty row space -->

						<?php 
							$_GET['cat'] = $Category;
							@include("featured.php"); 
						?>


					</div> <!-- Close left -->

					<div class="right property_listing"  style="width:75%;">
						<div class="title">Property Listing</div>
						<div class="property_listing_container" id="results">
							
						</div> <!-- Close property_listing_container -->
						<?php 
							$Conn = Connection::get_DefaultConnection();
							$results = Count($TableName::LoadCollection($Conn, $Filter));
							$item_per_page = 6;
							$pages = ceil($results/$item_per_page);	
							
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
			$("#results").load("getSearchPropertyListing.php", {'page':1, 'cat':<?php echo $Category; ?>, 'filter':<?php echo "'" . $Filter . "'"; ?>}, function() {$("#1-page").addClass('active');});  //initial page number to load
			
			$(".paginate_click").click(function (e) {
				var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
				var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
				$('.paginate_click').removeClass('active'); //remove any active class
				$("#results").load("getSearchPropertyListing.php", {'page':(page_num),'cat':<?php echo $Category; ?>, 'filter':<?php echo "'" . $Filter . "'"; ?>}, function(){

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