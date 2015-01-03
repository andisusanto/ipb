<?php include_once('Classes/User.php'); ?>
<?php
$UserName = $_POST['login_name'];
$Password = $_POST['login_password'];
$Connection = Connection::get_DefaultConnection();

if ($User = User::GetObjectByUserName($Connection,$UserName)){
	if ($User->ComparePassword($Password)){
		session_start();
		$_SESSION['User'] = $User;
        header('location:Dashboard.php');
	}
	else
	{
		header('location:index.php?error=1');
	}
}
else
{
	header('location:index.php?error=1');
}
?>