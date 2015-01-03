<?php
include_once('Classes/Connection.php');
include_once('Classes/News.php');
session_start();
$Id = $_POST['Id'];
$Title = $_POST['Title'];
$Description = $_POST['Description'];
if(isset($_POST['Active'])){$Active= 1;}else{$Active=0;}
$NewsDate = $_POST['NewsDate'];
$stamp = date('Y-m-d-h-s');
$uploaddir = '../images/News/';
$fileName = $_FILES['ImageName']['name'];     
$tmpName  = $_FILES['ImageName']['tmp_name'];
$fileName = $stamp.'-'.$fileName;
$uploadfile = $uploaddir . $fileName;

try {
	$conn = Connection::get_DefaultConnection();
	$News = News::GetObjectByKey($conn, $Id);
	$News->Title = $Title;
	$News->Description = $Description;
	$News->NewsDate = $NewsDate;
	$News->Active = $Active;
	if($fileName !== $stamp.'-'){
			move_uploaded_file($tmpName, $uploadfile);
			$News->ImageName = $fileName;
		}
	$News->Update();
	$conn->Commit();

	header('location:News.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>