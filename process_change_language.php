<?php

	session_start();
	
	if($_POST['Language'] =='EN'){
		$_SESSION['Language'] = 'en';
	}
	elseif($_POST['Language'] =='ID'){
		$_SESSION['Language'] = 'id';
	}

	header('location:'.$_POST['ReturnURL']);
?> 