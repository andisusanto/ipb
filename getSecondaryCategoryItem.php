<div style="height: 500px">
<?php 
include_once('admin-panel/Classes/Connection.php'); 
include_once('admin-panel/Classes/Currency.php'); 
include_once('admin-panel/Classes/SecondaryProperty.php'); 
include_once('admin-panel/Classes/SecondaryPropertyImage.php'); 

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}

$Conn = Connection::get_DefaultConnection();
$SecondaryPropertys = SecondaryProperty::LoadCollection($Conn, "Active = 1", "Id DESC", $page_number, 8);
foreach($SecondaryPropertys as $SecondaryProperty){
	echo '<div class="pagination_tabs_item">';
	echo '<a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'">';
        $SecondaryPropertyImages = SecondaryPropertyImage::LoadCollection($Conn, "Active = 1 AND SecondaryProperty =". $SecondaryProperty->get_Id(), "", 1, 1);
        foreach ($SecondaryPropertyImages as $SecondaryPropertyImage) {
                echo '<div class="image"><a href="secondary_property.php?Id='.$SecondaryProperty->get_Id().'"><img src="img.php?src=SecondaryPropertys/'.$SecondaryPropertyImage->ImageName.'&w=300" width="190" height="150"></a></div>';
        }
        echo '</a>';
	echo '<div class="title">'.$SecondaryProperty->Title.'</div>';
	echo '<div class="detail">';
	$Currency = Currency::GetObjectByKey($Conn, $SecondaryProperty->Currency);     
        echo '<div class="price">'.$Currency->Symbol.' '.number_format($SecondaryProperty->Price).'</div>';
        echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$SecondaryProperty->Bedroom.'</div>';
	echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$SecondaryProperty->Bathroom.'</div>';
	echo '</div>';
	echo '</div>';
}

$results = Count(SecondaryProperty::LoadCollection($Conn, "Active = 1"));
$item_per_page = 8;
$pages = ceil($results/$item_per_page);       
if($pages >= 1){
        $paginate       = '</div><div>';
        $paginate       .= '<ul class="paginate row">';
        for($i = 1; $i<=$pages; $i++){
                $tmpActive = $page_number == $i ? " active" : "";
                $paginate .= '<li><a href="#" class="paginate_click'.$tmpActive.'" id="'.$i.'-page">'.$i.'</a></li>';
        }
        $paginate .= '</ul></div>';
}
echo $paginate;
?>

<script type="text/javascript">
        $(".paginate_click").click(function (e) {
                var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
                var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
                $('.paginate_click').removeClass('active'); //remove any active class
                $("#result").load("getSecondaryCategoryItem.php", {'page':(page_num)}, function(){});
                return false; //prevent going to herf link
        });     
</script>