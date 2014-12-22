<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Banner extends BaseObject{
   const TABLENAME = 'Banner';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Link;
    public $Title;
    public $ImageName;
    public $Active;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Link,Title,ImageName,Active,LockField) VALUES('".$mySQLi->real_escape_string($this->Link)."','".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Link = '".$mySQLi->real_escape_string($this->Link)."', Title = '".$mySQLi->real_escape_string($this->Title)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', Active = '".$mySQLi->real_escape_string($this->Active)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpBanner = new Banner($mySQLi);
               $tmpBanner->Id = $row['Id'];
               $tmpBanner->Link = $row['Link'];
               $tmpBanner->Title = $row['Title'];
               $tmpBanner->ImageName = $row['ImageName'];
               $tmpBanner->Active = $row['Active'];

               $tmpBanner->LockField = $row['LockField'];
               return $tmpBanner;
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
           $Banners = array();
           while ($row = $result->fetch_array()){
               $tmpBanner = new Banner($mySQLi);
               $tmpBanner->Id = $row['Id'];
               $tmpBanner->LockField = $row['LockField'];
               $tmpBanner->Link = $row['Link'];
               $tmpBanner->Title = $row['Title'];
               $tmpBanner->ImageName = $row['ImageName'];
               $tmpBanner->Active = $row['Active'];

               $Banners[] = $tmpBanner;
           }
           return $Banners;
       }
       else
       {
           echo $tmpQuery;
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