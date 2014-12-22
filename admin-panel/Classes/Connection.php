<?php
class Connection{
	//const DBNAME = 'iPropertyBatam2';
	//const HOST = 'iPropertyBatam2.db.11702415.hostedresource.com';
	//const USERNAME = 'iPropertyBatam2';
	//const PASSWORD = 'iPB@2014';
	
	// local database
	const DBNAME = 'iPropertyBatam2';
	const HOST = 'localhost';
	const USERNAME = 'root';
	const PASSWORD = '';


	public static function get_DefaultConnection(){
		$tmpConn = new MySQLi(Connection::HOST,Connection::USERNAME,Connection::PASSWORD,Connection::DBNAME);
		$tmpConn->autocommit(false);
		if ($tmpConn->connect_error){
			throw new Exception("Error on connecting to database");
		}
		return $tmpConn;
	}
}
?>