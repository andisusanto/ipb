<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class RentProperty extends BaseObject{
   const TABLENAME = 'RentProperty';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Bathroom;
    public $BuildingArea;
    public $Marketing;
    public $Price;
    public $FunitureIncluded;
    public $Bedroom;
    public $LandArea;
    public $Title;
    public $Currency;
    public $MapImage;
    public $Description;
    public $MinimumContract;
    public $Location;
    public $Active;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Bathroom,BuildingArea,Marketing,Price,FunitureIncluded,Bedroom,LandArea,Title,Currency,MapImage,Description,MinimumContract,Location,Active,LockField) VALUES('".$mySQLi->real_escape_string($this->Bathroom)."','".$mySQLi->real_escape_string($this->BuildingArea)."','".$mySQLi->real_escape_string($this->Marketing)."','".$mySQLi->real_escape_string($this->Price)."','".$mySQLi->real_escape_string($this->FunitureIncluded)."','".$mySQLi->real_escape_string($this->Bedroom)."','".$mySQLi->real_escape_string($this->LandArea)."','".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Currency)."','".$mySQLi->real_escape_string($this->MapImage)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->MinimumContract)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Bathroom = '".$mySQLi->real_escape_string($this->Bathroom)."', BuildingArea = '".$mySQLi->real_escape_string($this->BuildingArea)."', Marketing = '".$mySQLi->real_escape_string($this->Marketing)."', Price = '".$mySQLi->real_escape_string($this->Price)."', FunitureIncluded = '".$mySQLi->real_escape_string($this->FunitureIncluded)."', Bedroom = '".$mySQLi->real_escape_string($this->Bedroom)."', LandArea = '".$mySQLi->real_escape_string($this->LandArea)."', Title = '".$mySQLi->real_escape_string($this->Title)."', Currency = '".$mySQLi->real_escape_string($this->Currency)."', MapImage = '".$mySQLi->real_escape_string($this->MapImage)."', Description = '".$mySQLi->real_escape_string($this->Description)."', MinimumContract = '".$mySQLi->real_escape_string($this->MinimumContract)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Active = '".$mySQLi->real_escape_string($this->Active)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_RentPropertyImage($page=0,$totalitem=0){
       return RentPropertyImage::LoadCollection($this->get_mySQLi(),"RentProperty = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpRentProperty = new RentProperty($mySQLi);
               $tmpRentProperty->Id = $row['Id'];
               $tmpRentProperty->Bathroom = $row['Bathroom'];
               $tmpRentProperty->BuildingArea = $row['BuildingArea'];
               $tmpRentProperty->Marketing = $row['Marketing'];
               $tmpRentProperty->Price = $row['Price'];
               $tmpRentProperty->FunitureIncluded = $row['FunitureIncluded'];
               $tmpRentProperty->Bedroom = $row['Bedroom'];
               $tmpRentProperty->LandArea = $row['LandArea'];
               $tmpRentProperty->Title = $row['Title'];
               $tmpRentProperty->Currency = $row['Currency'];
               $tmpRentProperty->MapImage = $row['MapImage'];
               $tmpRentProperty->Description = $row['Description'];
               $tmpRentProperty->MinimumContract = $row['MinimumContract'];
               $tmpRentProperty->Location = $row['Location'];
               $tmpRentProperty->Active = $row['Active'];

               $tmpRentProperty->LockField = $row['LockField'];
               return $tmpRentProperty;
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
           $RentPropertys = array();
           while ($row = $result->fetch_array()){
               $tmpRentProperty = new RentProperty($mySQLi);
               $tmpRentProperty->Id = $row['Id'];
               $tmpRentProperty->LockField = $row['LockField'];
               $tmpRentProperty->Bathroom = $row['Bathroom'];
               $tmpRentProperty->BuildingArea = $row['BuildingArea'];
               $tmpRentProperty->Marketing = $row['Marketing'];
               $tmpRentProperty->Price = $row['Price'];
               $tmpRentProperty->FunitureIncluded = $row['FunitureIncluded'];
               $tmpRentProperty->Bedroom = $row['Bedroom'];
               $tmpRentProperty->LandArea = $row['LandArea'];
               $tmpRentProperty->Title = $row['Title'];
               $tmpRentProperty->Currency = $row['Currency'];
               $tmpRentProperty->MapImage = $row['MapImage'];
               $tmpRentProperty->Description = $row['Description'];
               $tmpRentProperty->MinimumContract = $row['MinimumContract'];
               $tmpRentProperty->Location = $row['Location'];
               $tmpRentProperty->Active = $row['Active'];

               $RentPropertys[] = $tmpRentProperty;
           }
           return $RentPropertys;
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