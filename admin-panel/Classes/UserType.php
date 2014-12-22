<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class UserType extends BaseObject{
   const TABLENAME = 'UserType';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Name;
    public $Code;
    public $Active;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Name,Code,Active,LockField) VALUES('".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Name = '".$mySQLi->real_escape_string($this->Name)."', Code = '".$mySQLi->real_escape_string($this->Code)."', Active = '".$mySQLi->real_escape_string($this->Active)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_Land($page=0,$totalitem=0){
       return Land::LoadCollection($this->get_mySQLi(),"UserType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SecondaryProperty($page=0,$totalitem=0){
       return SecondaryProperty::LoadCollection($this->get_mySQLi(),"UserType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_User($page=0,$totalitem=0){
       return User::LoadCollection($this->get_mySQLi(),"UserType = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_NewPropertyMarketing($page=0,$totalitem=0){
       return NewPropertyMarketing::LoadCollection($this->get_mySQLi(),"UserType = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpUserType = new UserType($mySQLi);
               $tmpUserType->Id = $row['Id'];
               $tmpUserType->Name = $row['Name'];
               $tmpUserType->Code = $row['Code'];
               $tmpUserType->Active = $row['Active'];

               $tmpUserType->LockField = $row['LockField'];
               return $tmpUserType;
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
           $UserTypes = array();
           while ($row = $result->fetch_array()){
               $tmpUserType = new UserType($mySQLi);
               $tmpUserType->Id = $row['Id'];
               $tmpUserType->LockField = $row['LockField'];
               $tmpUserType->Name = $row['Name'];
               $tmpUserType->Code = $row['Code'];
               $tmpUserType->Active = $row['Active'];

               $UserTypes[] = $tmpUserType;
           }
           return $UserTypes;
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