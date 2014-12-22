<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class NewPropertyImage extends BaseObject{
   const TABLENAME = 'NewPropertyImage';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $NewProperty;
    public $ImageName;
    public $Active;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(NewProperty,ImageName,Active,LockField) VALUES('".$mySQLi->real_escape_string($this->NewProperty)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET NewProperty = '".$mySQLi->real_escape_string($this->NewProperty)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', Active = '".$mySQLi->real_escape_string($this->Active)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpNewPropertyImage = new NewPropertyImage($mySQLi);
               $tmpNewPropertyImage->Id = $row['Id'];
               $tmpNewPropertyImage->NewProperty = $row['NewProperty'];
               $tmpNewPropertyImage->ImageName = $row['ImageName'];
               $tmpNewPropertyImage->Active = $row['Active'];

               $tmpNewPropertyImage->LockField = $row['LockField'];
               return $tmpNewPropertyImage;
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
           $NewPropertyImages = array();
           while ($row = $result->fetch_array()){
               $tmpNewPropertyImage = new NewPropertyImage($mySQLi);
               $tmpNewPropertyImage->Id = $row['Id'];
               $tmpNewPropertyImage->LockField = $row['LockField'];
               $tmpNewPropertyImage->NewProperty = $row['NewProperty'];
               $tmpNewPropertyImage->ImageName = $row['ImageName'];
               $tmpNewPropertyImage->Active = $row['Active'];

               $NewPropertyImages[] = $tmpNewPropertyImage;
           }
           return $NewPropertyImages;
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