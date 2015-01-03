<?php include_once('UserBase.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class User extends UserBase{
   const TABLENAME = 'User';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Active;
    public $ProfilePicture;
    public $UserType;
    public $Username;
    public $Name;
    public $Address;
    public $ContactNumber;
    public $Email;
    public $StoredPassword;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Active,ProfilePicture,UserType,Username,Name,Address,ContactNumber,Email,Password,LockField) VALUES('".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->ProfilePicture)."','".$mySQLi->real_escape_string($this->UserType)."','".$mySQLi->real_escape_string($this->Username)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Address)."','".$mySQLi->real_escape_string($this->ContactNumber)."','".$mySQLi->real_escape_string($this->Email)."','".$mySQLi->real_escape_string($this->StoredPassword)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Active = '".$mySQLi->real_escape_string($this->Active)."', ProfilePicture = '".$mySQLi->real_escape_string($this->ProfilePicture)."', UserType = '".$mySQLi->real_escape_string($this->UserType)."', Username = '".$mySQLi->real_escape_string($this->Username)."', Name = '".$mySQLi->real_escape_string($this->Name)."', Address = '".$mySQLi->real_escape_string($this->Address)."', ContactNumber = '".$mySQLi->real_escape_string($this->ContactNumber)."', Email = '".$mySQLi->real_escape_string($this->Email)."', Password = '".$mySQLi->real_escape_string($this->StoredPassword)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpUser = new User($mySQLi);
               $tmpUser->Id = $row['Id'];
               $tmpUser->Active = $row['Active'];
               $tmpUser->ProfilePicture = $row['ProfilePicture'];
               $tmpUser->UserType = $row['UserType'];
               $tmpUser->Username = $row['Username'];
               $tmpUser->Name = $row['Name'];
               $tmpUser->Address = $row['Address'];
               $tmpUser->ContactNumber = $row['ContactNumber'];
               $tmpUser->Email = $row['Email'];
               $tmpUser->StoredPassword = $row['Password'];

               $tmpUser->LockField = $row['LockField'];
               return $tmpUser;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function GetObjectByUserName($mySQLi, $Username){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE UserName = '".$mySQLi->real_escape_string($Username)."' LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpUser = new User($mySQLi);
               $tmpUser->Id = $row['Id'];
               $tmpUser->Active = $row['Active'];
               $tmpUser->ProfilePicture = $row['ProfilePicture'];
               $tmpUser->UserType = $row['UserType'];
               $tmpUser->Username = $row['Username'];
               $tmpUser->Name = $row['Name'];
               $tmpUser->Address = $row['Address'];
               $tmpUser->ContactNumber = $row['ContactNumber'];
               $tmpUser->Email = $row['Email'];
               $tmpUser->StoredPassword = $row['Password'];

               $tmpUser->LockField = $row['LockField'];
               return $tmpUser;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function LoadCollection($mySQLi, $Criteria = '1 = 1',$sort='',$page=0,$totalitem=0){
       $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$mySQLi->real_escape_string($Criteria);
       if ($sort != ''){ $tmpQuery .= " "."ORDER BY ".$sort; }
       if ($page > 0 && $totalitem > 0){
           $start = ($page-1) * $totalitem;
           $tmpQuery .= " LIMIT ".$start.",".$totalitem;
       }
       if ($result = $mySQLi->query($tmpQuery)){
           $Users = array();
           while ($row = $result->fetch_array()){
               $tmpUser = new User($mySQLi);
               $tmpUser->Id = $row['Id'];
               $tmpUser->LockField = $row['LockField'];
               $tmpUser->Active = $row['Active'];
               $tmpUser->ProfilePicture = $row['ProfilePicture'];
               $tmpUser->UserType = $row['UserType'];
               $tmpUser->Username = $row['Username'];
               $tmpUser->Name = $row['Name'];
               $tmpUser->Address = $row['Address'];
               $tmpUser->ContactNumber = $row['ContactNumber'];
               $tmpUser->Email = $row['Email'];
               $tmpUser->StoredPassword = $row['Password'];

               $Users[] = $tmpUser;
           }
           return $Users;
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function Delete($mySQLi,$Id){
       if ($result = $mySQLi->query("DELETE FROM ".self::TABLENAME." WHERE Id=".$mySQLi->real_escape_string($Id))){
           if ($mySQLi->affected_rows == 0){
               throw new ObjectNotFoundException;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
}
?>