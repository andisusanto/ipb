<div class="header">
				<div class="top_header">
					<div class="language">
						<form id='frmLanguage' method='post' action='process_change_language.php'>
							<input type="hidden" name='ReturnURL' />
							<input type="hidden" name='Language' />
							<a class='btnlanguage' href='#' name='EN'>EN</a> | <a class='btnlanguage' href='#' name='ID'>ID</a>
						</form>
					</div>  
				</div>
				<div class="row">
					<div class="logo_area">
						<a href="index.php"><img src="images/logo.png"></a>
					</div>
					<div class="navigation">
						<ul>
							<li><a href="new_property_listing.php" id="new_property"><?php echo $LangNewProperty ?></a></li>
							<li><a href="secondary_property_listing.php" id="secondary_property"><?php echo $LangSecondaryProperty ?></a></li>
							<li><a href="rent_property_listing.php" id="rent_property"><?php echo $LangRentProperty ?></a></li>
							<li><a href="land_for_sale_listing.php" id="land_for_sale"><?php echo $LangLand ?></a></li>
							<li><a href="news.php" id="news_page"><?php echo $LangNews ?></a></li>
							<li><a href="contact_us.php" id="contact_us"><?php echo $LangContact ?></a></li>
						</ul>
					</div>
				</div>
			</div>