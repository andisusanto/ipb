<?php include_once('Classes/User.php'); ?>
<?php
$UserName = $_POST['login_name'];
$Password = $_POST['login_password'];
$Connection = Connection::get_DefaultConnection();

if ($User = User::GetObjectByUserName($Connection,$UserName)){
	if ($Member->ComparePassword($Password)){
		$_SESSION['User'] = $User;
        header('location:dashboard.php');
	}
	else
	{
		echo 'User or password not match';
	}
}
else
{
	echo 'User or password not match';
}
?>