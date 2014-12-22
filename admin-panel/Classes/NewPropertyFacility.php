<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class NewPropertyFacility extends BaseObject{
   const TABLENAME = 'NewPropertyFacility';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Facility;
    public $NewProperty;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Facility,NewProperty,LockField) VALUES('".$mySQLi->real_escape_string($this->Facility)."','".$mySQLi->real_escape_string($this->NewProperty)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Facility = '".$mySQLi->real_escape_string($this->Facility)."', NewProperty = '".$mySQLi->real_escape_string($this->NewProperty)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpNewPropertyFacility = new NewPropertyFacility($mySQLi);
               $tmpNewPropertyFacility->Id = $row['Id'];
               $tmpNewPropertyFacility->Facility = $row['Facility'];
               $tmpNewPropertyFacility->NewProperty = $row['NewProperty'];

               $tmpNewPropertyFacility->LockField = $row['LockField'];
               return $tmpNewPropertyFacility;
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
           $NewPropertyFacilitys = array();
           while ($row = $result->fetch_array()){
               $tmpNewPropertyFacility = new NewPropertyFacility($mySQLi);
               $tmpNewPropertyFacility->Id = $row['Id'];
               $tmpNewPropertyFacility->LockField = $row['LockField'];
               $tmpNewPropertyFacility->Facility = $row['Facility'];
               $tmpNewPropertyFacility->NewProperty = $row['NewProperty'];

               $NewPropertyFacilitys[] = $tmpNewPropertyFacility;
           }
           return $NewPropertyFacilitys;
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