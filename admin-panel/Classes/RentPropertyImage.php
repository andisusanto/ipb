<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class RentPropertyImage extends BaseObject{
   const TABLENAME = 'RentPropertyImage';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $RentProperty;
    public $Active;
    public $ImageName;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(RentProperty,Active,ImageName,LockField) VALUES('".$mySQLi->real_escape_string($this->RentProperty)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET RentProperty = '".$mySQLi->real_escape_string($this->RentProperty)."', Active = '".$mySQLi->real_escape_string($this->Active)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpRentPropertyImage = new RentPropertyImage($mySQLi);
               $tmpRentPropertyImage->Id = $row['Id'];
               $tmpRentPropertyImage->RentProperty = $row['RentProperty'];
               $tmpRentPropertyImage->Active = $row['Active'];
               $tmpRentPropertyImage->ImageName = $row['ImageName'];

               $tmpRentPropertyImage->LockField = $row['LockField'];
               return $tmpRentPropertyImage;
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
           $RentPropertyImages = array();
           while ($row = $result->fetch_array()){
               $tmpRentPropertyImage = new RentPropertyImage($mySQLi);
               $tmpRentPropertyImage->Id = $row['Id'];
               $tmpRentPropertyImage->LockField = $row['LockField'];
               $tmpRentPropertyImage->RentProperty = $row['RentProperty'];
               $tmpRentPropertyImage->Active = $row['Active'];
               $tmpRentPropertyImage->ImageName = $row['ImageName'];

               $RentPropertyImages[] = $tmpRentPropertyImage;
           }
           return $RentPropertyImages;
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