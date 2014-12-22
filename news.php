<?php
include('checklanguage.php');
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="stylesheet" href="css/iPropertyBatam.css" />
		<style type="text/css">
			.content {
				background: url("images/coming_soon.jpg") center no-repeat;
				width: 100%;
				height: 500px;
			}
		</style>
		<title>iPropertyBatam - News</title>
	</head>
	<body class="news_page">
	<div id="wrap">
		<div class="container">
			
			<!-- Header -->
			<?php include("header.php") ?>

			<div class="content">

			</div> <!-- Close content -->
		</div> <!-- Close container -->
	</div> <!-- Close warp -->

	<!-- Footer -->
	<?php include("footer.php") ?>


	</body>
	<script type="text/javascript" src="inc/jquery-1.9.1.js"></script>
	<script type="text/javascript">

		jQuery(document).ready(function(){
			$(".btnlanguage").click(function(){
				$("input[name=Language]").val($(this).attr('name'));
				$("input[name=ReturnURL]").val(document.URL);
				$("#frmLanguage").submit();
			});
		});
	</script>
</html>