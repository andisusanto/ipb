<?php
include_once('Classes/Connection.php');
include_once('Classes/News.php');

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
	$conn = Connection::get_defaultConnection();
	$News = new News($conn);
	$News->ImageName = $fileName;
	$News->Title = $Title;
	$News->Description = $Description;
	$News->NewsDate = $NewsDate;
	$News->Active = $Active;
	if($fileName == $stamp.'-'){
		Throw new FileUploadException;
		} else {
			move_uploaded_file($tmpName, $uploadfile);
		}
	echo $News->get_SaveQuery();
	$News->Save();
	$conn->Commit();

	header('location:News.php');
} catch (Exception $e) {
	include('classes/ErrorHandler.php');
}
?>