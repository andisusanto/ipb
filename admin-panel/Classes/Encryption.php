<?php include_once('Encryptor.php'); ?>
<?php
class Encryption{
	public static function GetDefaultEncryptor(){
		$KEY = '@~!@#$%^&*())(*&^%$#@!';
	 	$CIPHER = MCRYPT_RIJNDAEL_256;
	 	$MODE = MCRYPT_MODE_ECB;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
		return new Encryptor($CIPHER,$KEY,$MODE,$iv);
	}
	
}
?>