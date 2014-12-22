<?php 
include_once('admin-panel/Classes/Advertisement.php');
include_once('admin-panel/Classes/Banner.php'); 
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/NewProperty.php');
include_once('admin-panel/Classes/NewPropertyImage.php');

include('checklanguage.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<link rel="stylesheet" type="text/css" href="inc/skdslider/skdslider.css" />
		<link rel="stylesheet" type="text/css" href="inc/slick-master/slick/slick.css" />
        <link rel="icon" type="image/png" href="http://ipropertybatam.com/images/favicon.png">
    	<title>iPropertyBatam - Batam's Leading Property Website</title>
	</head>
	<body class="home">
	<div id="wrap">
		<div class="container">
			
			<!-- Header -->
			<?php include("header.php") ?>

			<div class="content">
				<div class="row fixed_banner">
					<img src="images/top_banner.png">
				</div>
				<div class="row">
					<div class="banner_container">
						<div class="banner skdslider">
							<ul>
								<?php 
									$Conn = Connection::get_DefaultConnection();
									$Banners = Banner::LoadCollection($Conn, "Active = 1");
									foreach ($Banners as $Banner) {
										echo '<li>';
										echo '<img src="img.php?src=banners/'.$Banner->ImageName.'&w=780">';
										if($Banner->Link !== '') {
											echo '<div class="slide-desc">';
											echo '<h2>'.$Banner->Title.'</h2>';
											echo '<p><a href="'.$Banner->Link.'">Click for more information</a></p>';
											echo '</div>';
										}
										echo '</li>';
									}
								?>
							</ul>
						</div>
					</div>
					<div class="home_search_container"> 
						<?php include("search_form.php") ?>
					</div>
				</div>

				<div class="row new_launching">
					<div class="new_launching_container">
						
						<?php 
							$Conn = Connection::get_DefaultConnection();
							$NewPropertys = NewProperty::LoadCollection($Conn, "Active = 1");
							foreach ($NewPropertys as $NewProperty) {
								echo '<div>';
								$NewPropertyImages = NewPropertyImage::LoadCollection($Conn, "Active = 1 AND NewProperty =". $NewProperty->get_Id(), "", 1, 1);
								foreach ($NewPropertyImages as $NewPropertyImage) {
								echo '<a href="new_property.php?Id='.$NewProperty->get_Id().'">';
									echo '<img src="img.php?src=NewPropertys/'.$NewPropertyImage->ImageName.'&w=250" width="190" height="150" />';
								echo '</a>';}
								
								echo '<div class="new_launching_detail">';
								echo '<div class="price">'.$NewProperty->Title.'</div>';
								echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$NewProperty->Bedroom.'</div>';
								echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$NewProperty->Bathroom.'</div>';
								echo '</div>';
								echo '</div>';
								
									}
								?>
					</div>
				</div>

				<div class="row">
					<div class="pagination">
						<div class="row">
							<div class="title"><?php echo $LangLatestProperty ?></div>
							<div class="tabs">
								<ul>
								    <li><a href="#tabs_all">All</a></li>
								    <li><a href="#tabs_secondary">Secondary</a></li>
								    <li><a href="#tabs_rent">Rent</a></li>
								    <li><a href="#tabs_land">Land</a></li>
								</ul>
							</div>
						</div>
						<!--<div class="row pagination_tabs_container" id="results">-->
						<div class="row pagination_tabs_container">	
							<div id="tabs_all">ALL</div>
							<div id="tabs_secondary">SECONDARY</div>
							<div id="tabs_rent">RENT</div>
							<div id="tabs_land">LAND</div>
						</div>
						
					</div>
					<?php 
							$Conn = Connection::get_DefaultConnection();
							$Query = "
								SELECT COUNT(Id) FROM 
								(SELECT SecondaryProperty.Id, Title, Price, Bathroom, Bedroom, Currency.Symbol, 'secondary_property' AS Category
									FROM SecondaryProperty
									INNER JOIN Currency ON Currency.Id = SecondaryProperty.Currency
									WHERE SecondaryProperty.Active = 1

									UNION ALL

									SELECT RentProperty.Id, Title, Price, Bathroom, Bedroom, Currency.Symbol, 'rent_property' AS Category
									FROM RentProperty
									INNER JOIN Currency ON Currency.Id = RentProperty.Currency
									WHERE RentProperty.Active = 1

									UNION ALL

									SELECT Land.Id, Title, Price, 0 AS Bathroom, 0 AS Bedroom, Currency.Symbol, 'land_for_sale' AS Category
									FROM Land
									INNER JOIN Currency ON Currency.Id = Land.Currency
									WHERE Land.Active = 1
								 ) AS tmpTable
								";
							$results = mysqli_query($Conn, $Query);
							$get_total_rows = mysqli_fetch_array($results); //total records
							$item_per_page = 8;
							$pages = ceil($get_total_rows[0]/$item_per_page);	
							
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
				</div>

				<div class="row">
					<div class="news">
						<div class="main_news">
							<div><img src="images/banners/banner01.jpg"></div>
							<div class="title">Coming Soon</div>
							<div class="description">Coming soon all news about property in Indonesia.</div>
						</div>
						<div class="news_container">

							<div class="news_list">
								<div class="news_list_img"><img src="images/banners/banner01.jpg"></div>
								<div class="news_list_detail">
									<div class="title">Coming Soon</div>
							<div class="description">Coming soon all news about property in Indonesia.</div>
								</div>
							</div>
							
							<div class="news_list">
								<div class="news_list_img"><img src="images/banners/banner01.jpg"></div>
								<div class="news_list_detail">
									<div class="title">Coming Soon</div>
									<div class="description">Coming soon all news about property in Indonesia.</div>
								</div>
							</div>
							<div class="news_list">
								<div class="news_list_img"><img src="images/banners/banner01.jpg"></div>
								<div class="news_list_detail">
									<div class="title">Coming Soon</div>
									<div class="description">Coming soon all news about property in Indonesia.</div>
								</div>
							</div>
							<div class="news_list">
								<div class="news_list_img"><img src="images/banners/banner01.jpg"></div>
								<div class="news_list_detail">
									<div class="title">Coming Soon</div>
									<div class="description">Coming soon all news about property in Indonesia.</div>
								</div>
							</div>

						</div>
					</div>
					
					<div class="advertisement">
						<?php
							$Conn = Connection::get_DefaultConnection();
							$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnHome = 1", "", 1, 2);
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
				</div>

			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php include("footer.php") ?>

	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="inc/skdslider/skdslider.js"></script>
	<script type="text/javascript" src="inc/slick-master/slick/slick.js"></script>
	<script type="text/javascript" src="inc/jquery-ui.js"></script>
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

			$('.new_launching_container').slick({
			  slidesToShow: 4,
			  slidesToScroll: 1,
			  autoplay: true,
			  speed: 750
			});

			$(function() {
			    $( ".pagination" ).tabs({ 
			    	active: 0
			    });
			});
			
			$("#results").load("getMixedCategoryItem.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			
			$(".paginate_click").click(function (e) {
				var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
				var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
				$('.paginate_click').removeClass('active'); //remove any active class
				$("#results").load("getMixedCategoryItem.php", {'page':(page_num)}, function(){

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