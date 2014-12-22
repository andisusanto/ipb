<?php
include_once('Classes/Connection.php');
include_once('Classes/Banner.php');
$Id = $_POST['Id'];
$Link = $_POST['Link'];
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$Title = $_POST['Title'];
$stamp = date('Y-m-d-h-s');
$uploaddir = '../images/banners/';
$fileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$fileName = $stamp.'-'.$fileName;
$uploadfile = $uploaddir . $fileName;

try {
	$conn = Connection::get_DefaultConnection();
	$Banner = Banner::GetObjectByKey($conn, $Id);
	$Banner->Link = $Link;
	$Banner->Title = $Title;
	$Banner->Active = $Active;
	if($fileName !== $stamp.'-'){
			move_uploaded_file($tmpName, $uploadfile);
			$Banner->ImageName = $fileName;
		}
	$Banner->Update();
	$conn->Commit();

	header('location:Banner.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>