<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class SecondaryProperty extends BaseObject{
   const TABLENAME = 'SecondaryProperty';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Title;
    public $Location;
    public $Featured;
    public $Bedroom;
    public $Periods;
    public $Active;
    public $BuildingArea;
    public $Marketing;
    public $Certificate;
    public $Description;
    public $EstimatedInterestRate;
    public $LandArea;
    public $FunitureIncluded;
    public $Deposit;
    public $Price;
    public $Currency;
    public $Bathroom;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Title,Location,Featured,Bedroom,Periods,Active,BuildingArea,Marketing,Certificate,Description,EstimatedInterestRate,LandArea,FunitureIncluded,Deposit,Price,Currency,Bathroom,LockField) VALUES('".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Featured)."','".$mySQLi->real_escape_string($this->Bedroom)."','".$mySQLi->real_escape_string($this->Periods)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->BuildingArea)."','".$mySQLi->real_escape_string($this->Marketing)."','".$mySQLi->real_escape_string($this->Certificate)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->EstimatedInterestRate)."','".$mySQLi->real_escape_string($this->LandArea)."','".$mySQLi->real_escape_string($this->FunitureIncluded)."','".$mySQLi->real_escape_string($this->Deposit)."','".$mySQLi->real_escape_string($this->Price)."','".$mySQLi->real_escape_string($this->Currency)."','".$mySQLi->real_escape_string($this->Bathroom)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Title = '".$mySQLi->real_escape_string($this->Title)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Featured = '".$mySQLi->real_escape_string($this->Featured)."', Bedroom = '".$mySQLi->real_escape_string($this->Bedroom)."', Periods = '".$mySQLi->real_escape_string($this->Periods)."', Active = '".$mySQLi->real_escape_string($this->Active)."', BuildingArea = '".$mySQLi->real_escape_string($this->BuildingArea)."', Marketing = '".$mySQLi->real_escape_string($this->Marketing)."', Certificate = '".$mySQLi->real_escape_string($this->Certificate)."', Description = '".$mySQLi->real_escape_string($this->Description)."', EstimatedInterestRate = '".$mySQLi->real_escape_string($this->EstimatedInterestRate)."', LandArea = '".$mySQLi->real_escape_string($this->LandArea)."', FunitureIncluded = '".$mySQLi->real_escape_string($this->FunitureIncluded)."', Deposit = '".$mySQLi->real_escape_string($this->Deposit)."', Price = '".$mySQLi->real_escape_string($this->Price)."', Currency = '".$mySQLi->real_escape_string($this->Currency)."', Bathroom = '".$mySQLi->real_escape_string($this->Bathroom)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_SecondaryPropertyImage($page=0,$totalitem=0){
       return SecondaryPropertyImage::LoadCollection($this->get_mySQLi(),"SecondaryProperty = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSecondaryProperty = new SecondaryProperty($mySQLi);
               $tmpSecondaryProperty->Id = $row['Id'];
               $tmpSecondaryProperty->Title = $row['Title'];
               $tmpSecondaryProperty->Location = $row['Location'];
               $tmpSecondaryProperty->Featured = $row['Featured'];
               $tmpSecondaryProperty->Bedroom = $row['Bedroom'];
               $tmpSecondaryProperty->Periods = $row['Periods'];
               $tmpSecondaryProperty->Active = $row['Active'];
               $tmpSecondaryProperty->BuildingArea = $row['BuildingArea'];
               $tmpSecondaryProperty->Marketing = $row['Marketing'];
               $tmpSecondaryProperty->Certificate = $row['Certificate'];
               $tmpSecondaryProperty->Description = $row['Description'];
               $tmpSecondaryProperty->EstimatedInterestRate = $row['EstimatedInterestRate'];
               $tmpSecondaryProperty->LandArea = $row['LandArea'];
               $tmpSecondaryProperty->FunitureIncluded = $row['FunitureIncluded'];
               $tmpSecondaryProperty->Deposit = $row['Deposit'];
               $tmpSecondaryProperty->Price = $row['Price'];
               $tmpSecondaryProperty->Currency = $row['Currency'];
               $tmpSecondaryProperty->Bathroom = $row['Bathroom'];

               $tmpSecondaryProperty->LockField = $row['LockField'];
               return $tmpSecondaryProperty;
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
           $SecondaryPropertys = array();
           while ($row = $result->fetch_array()){
               $tmpSecondaryProperty = new SecondaryProperty($mySQLi);
               $tmpSecondaryProperty->Id = $row['Id'];
               $tmpSecondaryProperty->LockField = $row['LockField'];
               $tmpSecondaryProperty->Title = $row['Title'];
               $tmpSecondaryProperty->Location = $row['Location'];
               $tmpSecondaryProperty->Featured = $row['Featured'];
               $tmpSecondaryProperty->Bedroom = $row['Bedroom'];
               $tmpSecondaryProperty->Periods = $row['Periods'];
               $tmpSecondaryProperty->Active = $row['Active'];
               $tmpSecondaryProperty->BuildingArea = $row['BuildingArea'];
               $tmpSecondaryProperty->Marketing = $row['Marketing'];
               $tmpSecondaryProperty->Certificate = $row['Certificate'];
               $tmpSecondaryProperty->Description = $row['Description'];
               $tmpSecondaryProperty->EstimatedInterestRate = $row['EstimatedInterestRate'];
               $tmpSecondaryProperty->LandArea = $row['LandArea'];
               $tmpSecondaryProperty->FunitureIncluded = $row['FunitureIncluded'];
               $tmpSecondaryProperty->Deposit = $row['Deposit'];
               $tmpSecondaryProperty->Price = $row['Price'];
               $tmpSecondaryProperty->Currency = $row['Currency'];
               $tmpSecondaryProperty->Bathroom = $row['Bathroom'];

               $SecondaryPropertys[] = $tmpSecondaryProperty;
           }
           return $SecondaryPropertys;
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