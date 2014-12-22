<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class SecondaryPropertyImage extends BaseObject{
   const TABLENAME = 'SecondaryPropertyImage';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Active;
    public $ImageName;
    public $SecondaryProperty;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Active,ImageName,SecondaryProperty,LockField) VALUES('".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->SecondaryProperty)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Active = '".$mySQLi->real_escape_string($this->Active)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', SecondaryProperty = '".$mySQLi->real_escape_string($this->SecondaryProperty)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSecondaryPropertyImage = new SecondaryPropertyImage($mySQLi);
               $tmpSecondaryPropertyImage->Id = $row['Id'];
               $tmpSecondaryPropertyImage->Active = $row['Active'];
               $tmpSecondaryPropertyImage->ImageName = $row['ImageName'];
               $tmpSecondaryPropertyImage->SecondaryProperty = $row['SecondaryProperty'];

               $tmpSecondaryPropertyImage->LockField = $row['LockField'];
               return $tmpSecondaryPropertyImage;
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
           $SecondaryPropertyImages = array();
           while ($row = $result->fetch_array()){
               $tmpSecondaryPropertyImage = new SecondaryPropertyImage($mySQLi);
               $tmpSecondaryPropertyImage->Id = $row['Id'];
               $tmpSecondaryPropertyImage->LockField = $row['LockField'];
               $tmpSecondaryPropertyImage->Active = $row['Active'];
               $tmpSecondaryPropertyImage->ImageName = $row['ImageName'];
               $tmpSecondaryPropertyImage->SecondaryProperty = $row['SecondaryProperty'];

               $SecondaryPropertyImages[] = $tmpSecondaryPropertyImage;
           }
           return $SecondaryPropertyImages;
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