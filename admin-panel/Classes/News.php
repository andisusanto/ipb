<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class News extends BaseObject{
   const TABLENAME = 'News';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Title;
    public $Description;
    public $ImageName;
    public $NewsDate;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Title,Description,ImageName,NewsDate,LockField) VALUES('".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->NewsDate)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Title = '".$mySQLi->real_escape_string($this->Title)."', Description = '".$mySQLi->real_escape_string($this->Description)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', NewsDate = '".$mySQLi->real_escape_string($this->NewsDate)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpNews = new News($mySQLi);
               $tmpNews->Id = $row['Id'];
               $tmpNews->Title = $row['Title'];
               $tmpNews->Description = $row['Description'];
               $tmpNews->ImageName = $row['ImageName'];
               $tmpNews->NewsDate = $row['NewsDate'];

               $tmpNews->LockField = $row['LockField'];
               return $tmpNews;
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
           $Newss = array();
           while ($row = $result->fetch_array()){
               $tmpNews = new News($mySQLi);
               $tmpNews->Id = $row['Id'];
               $tmpNews->LockField = $row['LockField'];
               $tmpNews->Title = $row['Title'];
               $tmpNews->Description = $row['Description'];
               $tmpNews->ImageName = $row['ImageName'];
               $tmpNews->NewsDate = $row['NewsDate'];

               $Newss[] = $tmpNews;
           }
           return $Newss;
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