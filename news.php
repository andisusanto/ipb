<?php
include('checklanguage.php');
include_once('admin-panel/Classes/News.php');
include_once('admin-panel/Classes/Advertisement.php');
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Kami Menerima Titipan Jual Beli Sewa Property Batam Bebas Biaya Administrasi, Biaya Iklan dan Promosi! Hubungi: 0778-428 889 Email: Marketing@ipropertybatam.com" />
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<link rel="stylesheet" type="text/css" href="inc/slick-master/slick/slick.css" />
        <link rel="icon" type="image/png" href="http://ipropertybatam.com/images/favicon.png">
		<title>iPropertyBatam - Batam's Leading Property Website</title>
	</head>
	<body class="news_page">
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
							//$_GET['cat'] = '3';
							//@include("featured.php"); 
						?>

						<div class="advertisement">
							<?php
								$Conn = Connection::get_DefaultConnection();
								$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnNewsListing = 1", "", 0, 2);
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

					<div class="right news_listing"  style="width:75%;">
						<div class="title">Latest News</div>
						<div class="news_listing_container" id="results">
							
						</div> <!-- Close news_listing_container -->
						<?php 
						$results = Count(News::LoadCollection($Conn, "Active = 1"));
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

				<?php 
					$_GET['cat'] = '4';
					@include("featured_property.php"); 
				?>

			</div> <!-- Close content -->
		</div> <!-- Close container -->
	</div> <!-- Close warp -->

	<!-- Footer -->
	<?php include("footer.php") ?>


	</body>
	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="inc/slick-master/slick/slick.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#results").load("getNewsListing.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			
			$(".paginate_click").click(function (e) {
				var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
				var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
				$('.paginate_click').removeClass('active'); //remove any active class
				$("#results").load("getNewsListing.php", {'page':(page_num)}, function(){

				});
				$(this).addClass('active'); //add active class to currently clicked element (style purpose)
				return false; //prevent going to herf link
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
	</script>
</html>