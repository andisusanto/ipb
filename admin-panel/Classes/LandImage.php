<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class LandImage extends BaseObject{
   const TABLENAME = 'LandImage';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Active;
    public $Land;
    public $ImageName;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Active,Land,ImageName,LockField) VALUES('".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->Land)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Active = '".$mySQLi->real_escape_string($this->Active)."', Land = '".$mySQLi->real_escape_string($this->Land)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpLandImage = new LandImage($mySQLi);
               $tmpLandImage->Id = $row['Id'];
               $tmpLandImage->Active = $row['Active'];
               $tmpLandImage->Land = $row['Land'];
               $tmpLandImage->ImageName = $row['ImageName'];

               $tmpLandImage->LockField = $row['LockField'];
               return $tmpLandImage;
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
           $LandImages = array();
           while ($row = $result->fetch_array()){
               $tmpLandImage = new LandImage($mySQLi);
               $tmpLandImage->Id = $row['Id'];
               $tmpLandImage->LockField = $row['LockField'];
               $tmpLandImage->Active = $row['Active'];
               $tmpLandImage->Land = $row['Land'];
               $tmpLandImage->ImageName = $row['ImageName'];

               $LandImages[] = $tmpLandImage;
           }
           return $LandImages;
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