<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Facility extends BaseObject{
   const TABLENAME = 'Facility';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Name;
    public $Code;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Name,Code,LockField) VALUES('".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Name = '".$mySQLi->real_escape_string($this->Name)."', Code = '".$mySQLi->real_escape_string($this->Code)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_NewPropertyFacility($page=0,$totalitem=0){
       return NewPropertyFacility::LoadCollection($this->get_mySQLi(),"Facility = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpFacility = new Facility($mySQLi);
               $tmpFacility->Id = $row['Id'];
               $tmpFacility->Name = $row['Name'];
               $tmpFacility->Code = $row['Code'];

               $tmpFacility->LockField = $row['LockField'];
               return $tmpFacility;
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
           $Facilitys = array();
           while ($row = $result->fetch_array()){
               $tmpFacility = new Facility($mySQLi);
               $tmpFacility->Id = $row['Id'];
               $tmpFacility->LockField = $row['LockField'];
               $tmpFacility->Name = $row['Name'];
               $tmpFacility->Code = $row['Code'];

               $Facilitys[] = $tmpFacility;
           }
           return $Facilitys;
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