<?php include_once('BaseObject.php'); ?>
<?php include_once('Encryption.php'); ?>
<?php
abstract class UserBase extends BaseObject{
	public $UserName;
	public $Email;
	protected $EncryptedPassword;
	public function __construct($mySQLi){
		parent::__contruct($mySQLi);
	}
	public function SetPassword($Password){
		$enc = Encryption::GetDefaultEncryptor();
		$this->EncryptedPassword = $enc->Encrypt($Password);
	}
	public function ComparePassword($Password){
		$enc = Encryption::GetDefaultEncryptor();
		return $this->EncryptedPassword == $enc->Encrypt($Password);
	}
}
?>