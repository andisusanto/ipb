<div style="height: 500px">
<?php 
include_once('admin-panel/Classes/Connection.php'); 

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
if(!is_numeric($page_number)){die('Invalid page number!');}
$page_number -= 1;
$position = ($page_number * 8);

$Conn = Connection::get_DefaultConnection();
$Query = "
        SELECT * FROM 
                (SELECT SecondaryProperty.Id, Title, Price, Bathroom, Bedroom, Currency.Symbol, 'secondary_property' AS Category, 'SecondaryPropertys' AS ImagePath,  (SELECT ImageName FROM SecondaryPropertyImage WHERE SecondaryProperty = SecondaryProperty.Id LIMIT 0,1) AS ImageName
                        FROM SecondaryProperty
                        INNER JOIN Currency ON Currency.Id = SecondaryProperty.Currency
                        WHERE SecondaryProperty.Active = 1
                        
                UNION ALL
                        
                SELECT RentProperty.Id, Title, Price, Bathroom, Bedroom, Currency.Symbol, 'rent_property' AS Category, 'RentPropertys' AS ImagePath, (SELECT ImageName FROM RentPropertyImage WHERE RentProperty = RentProperty.Id LIMIT 0,1) AS ImageName
                FROM RentProperty
                INNER JOIN Currency ON Currency.Id = RentProperty.Currency
                WHERE RentProperty.Active = 1
                        
                UNION ALL
                        
                SELECT Land.Id, Title, Price, 0 AS Bathroom, 0 AS Bedroom, Currency.Symbol, 'land_for_sale' AS Category, 'Lands' AS ImagePath, (SELECT ImageName FROM LandImage WHERE Land = Land.Id LIMIT 0,1) AS ImageName
                FROM Land
                INNER JOIN Currency ON Currency.Id = Land.Currency
                WHERE Land.Active = 1
                                 
                ) AS tmpTable 
                               
        ORDER BY Id DESC LIMIT ".$position.", 8
        ";

$Datas = mysqli_query($Conn, $Query);
while ($Records = mysqli_fetch_array($Datas)){
	echo '<div class="pagination_tabs_item">';
	echo '<a href="'. $Records['Category'] .'.php?Id='.$Records['Id'].'"><img src="img.php?src='.$Records['ImagePath'].'/'.$Records['ImageName'].'&w=300" width="190" height="150"></a>';
	echo '<div class="title">'.$Records['Title'].'</div>';
	echo '<div class="detail">';
	echo '<div class="price">'.$Records['Symbol'].' '.number_format($Records['Price']).'</div>';
	echo '<div class="bedroom"><img src="images/bedroom_symbol.png"> '.$Records['Bedroom'].'</div>';
	echo '<div class="bathroom"><img src="images/bathroom_symbol.png"> '.$Records['Bathroom'].'</div>';
	echo '</div>';
	echo '</div>';
}

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
if($pages >= 1){
        $paginate       = '</div><div>';
        $paginate       .= '<ul class="paginate row">';
        for($i = 1; $i<=$pages; $i++){
                $paginate .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
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
                $("#result").load("getMixedCategoryItem.php", {'page':(page_num)}, function(){});
                $(this).addClass('active'); //add active class to currently clicked element (style purpose)
                return false; //prevent going to herf link
        });     
</script>