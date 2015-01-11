<?php 
include_once('admin-panel/Classes/Advertisement.php');
include_once('admin-panel/Classes/Banner.php'); 
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/NewProperty.php');
include_once('admin-panel/Classes/NewPropertyImage.php');
include_once('admin-panel/Classes/News.php');
include('checklanguage.php');
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
						<div class="row pagination_tabs_container">	
							<div id="tabs_all"></div>
							<div id="tabs_secondary"></div>
							<div id="tabs_rent"></div>
							<div id="tabs_land"></div>
						</div>
						
					</div>
					
				</div>

				<div class="row">
					<div class="news">
						<?php 
							$Newss = News::LoadCollection($Conn, 'Active = 1', 'NewsDate DESC', 1, 1);
							foreach ($Newss as $News) {
								echo '
									<a href="newsdetail.php?Id='.$News->get_Id().'">
										<div class="main_news">
											<div><img src="img.php?src=News/'.$News->ImageName.'&w=300""></div>
											<div class="title">'.$News->Title.'</div>
											<div class="description">'.$News->NewsDate.'<br>'.substr($News->Description, 0, 500).' ...</div>
										</div>
									</a>
								';
							}
						?>
						
						<div class="news_container">
							<?php 
								$Newss = News::LoadCollection($Conn, 'Active = 1', 'NewsDate DESC LIMIT 1, 4');
								foreach ($Newss as $News) {
									echo '
										<a href="newsdetail.php?Id='.$News->get_Id().'">
											<div class="news_list">
												<div class="news_list_img"><img src="img.php?src=News/'.$News->ImageName.'&w=100""></div>
												<div class="news_list_detail">
													<div class="title">'.$News->Title.'</div>
													<div class="description">'.$News->NewsDate.'<br>'.substr($News->Description, 0, 50).' ...</div>
												</div>
											</div>
										</a>
									';
								}
							?>
							

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
			
			$("#tabs_all").load("getMixedCategoryItem.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			$("#tabs_secondary").load("getSecondaryCategoryItem.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			$("#tabs_rent").load("getRentCategoryItem.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			$("#tabs_land").load("getLandCategoryItem.php", {'page':1}, function() {$("#1-page").addClass('active');});  //initial page number to load
			
			$(".btnlanguage").click(function(){
				$("input[name=Language]").val($(this).attr('name'));
				$("input[name=ReturnURL]").val(document.URL);
				$("#frmLanguage").submit();
			});
		});
	</script>
	</body>		
</html>