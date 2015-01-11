<?php
include_once('admin-panel/Classes/News.php');
include_once('admin-panel/Classes/Advertisement.php');

include('checklanguage.php');
$NewsId = $_GET['Id'];
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
    	<title>iPropertyBatam - News</title>
	</head>
	<body class="news_page">
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
						<div class="banner">
							
								<?php 
									$Conn = Connection::get_DefaultConnection();
									$News = News::GetObjectByKey($Conn, $NewsId);
									echo '<img src="img.php?src=News/'.$News->ImageName.'&w=740&h=380">';
									
								?>
							
						</div>

						<div class="newsdetail">
							<h2><?php echo $News->Title ?></h2>
							<?php echo $News->NewsDate ?>
							<p style="text-align: justify;">
								<?php echo $News->Description ?>
							</p>
						</div>
						
					</div> <!-- Close left -->

					<div class="right"  style="width:25%;">
						
						<div class="side_news">
								<div class="row marketing_title">Other News :</div>
								<?php 
									$Newss = News::LoadCollection($Conn, 'Active = 1', 'NewsDate DESC LIMIT 1, 4');
									foreach ($Newss as $News) {
										echo '
											<a href="newsdetail.php?Id='.$News->get_Id().'">
												<div class="news_list">
													<div class="news_list_img"><img src="img.php?src=News/'.$News->ImageName.'&w=100""></div>
													<div class="news_list_detail">
														<div class="title">'.$News->Title.'</div>
														<div class="description">'.$News->NewsDate.'<br/>'.substr($News->Description, 0, 50).' ...</div>
													</div>
												</div>
											</a>
										';
									}
								?>
						</div>
						<div>&nbsp;</div>
						<div class="advertisement">
							<?php
								$Conn = Connection::get_DefaultConnection();
								$Advertisements = Advertisement::LoadCollection($Conn, "Active = 1 AND ShowOnNewsListing = 1", "", 1, 2);
								$AdvCount = 0;
								foreach ($Advertisements as $Advertisement) {
									echo '<div class="row"><a href="'.$Advertisement->Link.'"><img src="images/News/'.$Advertisement->ImageName.'"></a></div>';
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
					$_GET['cat'] = '4';
					@include("featured_property.php"); 
				?>


			</div> <!-- Close content -->
		</div> <!-- Close container -->
	</div> <!-- Close warp -->

	<!-- Footer -->
	<?php include("footer.php") ?>

	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="inc/slick-master/slick/slick.js"></script>
	<script type="text/javascript">

		jQuery(document).ready(function(){
			

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