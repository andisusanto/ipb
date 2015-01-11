<?php 
include_once('admin-panel/Classes/Location.php');
include_once('admin-panel/Classes/Currency.php');
$category = isset($_GET['cat']) ? $_GET['cat'] : ''; 
?>

<div class="search_form" >
						<div class="search_form_container">
							<div class="search_form_header">
								<div class="title"><?php echo $LangFindPropertyBatam ?></div>
								<div class="search_icon"></div>
							</div>

							<form name="SearchForm" action="search.php" method="POST">
								<div class="row search_component">
										<?php 
											if($category==''){
												echo '<select name="Category" required>';
												echo '<option value="">'.$LangSearchCategory.'</option>';
												//echo '<option value="0">Any Category</option>';
											}else{
												echo '<select name="Category" disabled>';
											}
											if($category==1){
												echo '<option value="1" selected>Secondary Property</option>';
											}else{
												echo '<option value="1">Secondary Property</option>';
											}
											if($category==2){
												echo '<option value="2" selected>Rent Property</option>';
											}else{
												echo '<option value="2">Rent Property</option>';
											}
											if($category==3){
												echo '<option value="3" selected>Land</option>';
											}else{
												echo '<option value="3">Land</option>';
											}
										?>
										
									</select>
								</div>
								<div class="row search_component">
									<select name="Location" required >
										<option value="" default selected><?php echo $LangSearchLocation ?></option>
										<option value="0">Any Location</option>
										<?php 
											$Conn = Connection::get_DefaultConnection();
											$Locations = Location::LoadCollection($Conn);

											foreach ($Locations as $Location) {
												echo '<option value="'.$Location->get_Id().'">'.$Location->Name.'</option>';
											}
										?>
										
									</select>
								</div>
								
								<div class="row search_component">
									<div style="width:100px;float:left;">
										<select name="Bedroom" required style="width:100px;">
											<option value="" default selected><?php echo $LangSearchBedroom ?></option>
											<option value="0">Any</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
										</select>
									</div>
									<div style="width:100px; float:right;">
										<select name="Bathroom" required style="width:100px;">
											<option value="" required default selected><?php echo $LangSearchBathroom ?></option>
											<option value="0">Any</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
									</select>
									</div>
								</div>
								<div class="row search_component">
									<select name="Currency" required>
										<option value="" default selected><?php echo $LangSearchCurrency ?></option>
										<?php 
											$Conn = Connection::get_DefaultConnection();
											$Currencys = Currency::LoadCollection($Conn);
											foreach ($Currencys as $Currency) {
												echo '<option value="'.$Currency->get_Id().'">'.$Currency->Code.'</option>';
											}
										?>
									</select>
								</div>
								<div class="row search_component">
									<div style="width:100px;float:left;">
										<select name="MinPrice" required style="width:100px;">
											<option value="" default selected><?php echo $LangSearchMinPrice ?></option>
											<option value="0">Any</option>
											<option value="20000">20.000</option>
											<option value="50000">50.000</option>
											<option value="100000">100.000</option>
											<option value="200000">200.000</option>
											<option value="500000">500.000</option>
											<option value="1000000">1.000.000</option>
											<option value="2000000">2.000.000</option>
											<option value="5000000">5.000.000</option>
											<option value="10000000">10.000.000</option>
											<option value="20000000">20.000.000</option>
											<option value="50000000">50.000.000</option>
											<option value="100000000">100.000.000</option>
											<option value="200000000">200.000.000</option>
											<option value="500000000">500.000.000</option>
											<option value="1000000000">1.000.000.000</option>
											<option value="2000000000">2.000.000.000</option>
											<option value="5000000000">5.000.000.000</option>
											<option value="10000000000">10.000.000.000</option>
										</select>
									</div>
									<div style="width:100px; float:right;">
										<select name="MaxPrice" required style="width:100px;">
											<option value="" default selected><?php echo $LangSearchMaxPrice ?></option>
											<option value="0">Any</option>
											<option value="20000">20.000</option>
											<option value="50000">50.000</option>
											<option value="100000">100.000</option>
											<option value="200000">200.000</option>
											<option value="500000">500.000</option>
											<option value="1000000">1.000.000</option>
											<option value="2000000">2.000.000</option>
											<option value="5000000">5.000.000</option>
											<option value="10000000">10.000.000</option>
											<option value="20000000">20.000.000</option>
											<option value="50000000">50.000.000</option>
											<option value="100000000">100.000.000</option>
											<option value="200000000">200.000.000</option>
											<option value="500000000">500.000.000</option>
											<option value="1000000000">1.000.000.000</option>
											<option value="2000000000">2.000.000.000</option>
											<option value="5000000000">5.000.000.000</option>
											<option value="10000000000">10.000.000.000</option>
										</select>
									</div>
								</div>
								<div class="row search_component">
									<input type="submit" name="submit" value="Search">
								</div>
							</form>
						</div>
					</div>