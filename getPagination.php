<?php
$totalItem = $_POST['totalItem'];
$totalPageItem = $_POST['totalPageItem'];
$totalDBItem = ceil($totalItem/$totalPageItem);
if($totalDBItem == 1) {
	echo '<a id="1" href="#"></a>';
}else{
	for ($i=1; $i < $totalDBItem; $i++) { 
		echo '<a id="'.$i.'" href="#">'.$i.'</a>';
	}
}
?>