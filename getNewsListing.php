<?php include_once('admin-panel/Classes/News.php');

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

$Conn = Connection::get_DefaultConnection();
$Newss = News::LoadCollection($Conn, "Active = 1", "Id DESC", $page_number, 6);
foreach($Newss as $News){
									echo '<div class="property_listing_detail">';
									echo '<div class="title"><a href="newsdetail.php?Id='.$News->get_Id().'">'.$News->Title.'</a></div>';
									echo '<div class="image"><a href="newsdetail.php?Id='.$News->get_Id().'"><img src="img.php?src=News/'.$News->ImageName.'&w=300"></a></div>';
									echo '<div class="description"><b>'.$News->NewsDate.'</b><br /> '.substr($News->Description, 0, 400).'</div>';
									echo '<div class="more_detail_link"><a href="newsdetail.php?Id='.$News->get_Id().'">More Detail</a></div>';
									echo '</div>';
								}			
?>