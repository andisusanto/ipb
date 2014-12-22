<?php
class Encryptor{
	private $key;
	private $cipher;
	private $mode;
	private $iv;
	
	public function __construct($cipher,$key,$mode,$iv){
		$this->key = $key;
		$this->cipher = $cipher;
		$this->mode = $mode;
		$this->iv = $iv;
	}
	
	public function Encrypt($text){
		return mcrypt_encrypt($this->cipher,$this->key,$text,$this->mode,$this->iv);
	}
	
	public function Decrypt($ciphertext){
		return mcrypt_decrypt($this->cipher,$this->key,$ciphertext,$this->mode,$this->iv);
	}
}
?>