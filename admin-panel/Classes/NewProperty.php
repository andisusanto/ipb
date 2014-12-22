<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class NewProperty extends BaseObject{
   const TABLENAME = 'NewProperty';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Description;
    public $Currency;
    public $MaxPrice;
    public $Active;
    public $MapImage;
    public $Featured;
    public $Bedroom;
    public $Platfond;
    public $Roof;
    public $Bathroom;
    public $Foundation;
    public $MainDoor;
    public $Location;
    public $Floor;
    public $Window;
    public $RoofFrame;
    public $MinPrice;
    public $Wall;
    public $Title;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Description,Currency,MaxPrice,Active,MapImage,Featured,Bedroom,Platfond,Roof,Bathroom,Foundation,MainDoor,Location,Floor,Window,RoofFrame,MinPrice,Wall,Title,LockField) VALUES('".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->Currency)."','".$mySQLi->real_escape_string($this->MaxPrice)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->MapImage)."','".$mySQLi->real_escape_string($this->Featured)."','".$mySQLi->real_escape_string($this->Bedroom)."','".$mySQLi->real_escape_string($this->Platfond)."','".$mySQLi->real_escape_string($this->Roof)."','".$mySQLi->real_escape_string($this->Bathroom)."','".$mySQLi->real_escape_string($this->Foundation)."','".$mySQLi->real_escape_string($this->MainDoor)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Floor)."','".$mySQLi->real_escape_string($this->Window)."','".$mySQLi->real_escape_string($this->RoofFrame)."','".$mySQLi->real_escape_string($this->MinPrice)."','".$mySQLi->real_escape_string($this->Wall)."','".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Description = '".$mySQLi->real_escape_string($this->Description)."', Currency = '".$mySQLi->real_escape_string($this->Currency)."', MaxPrice = '".$mySQLi->real_escape_string($this->MaxPrice)."', Active = '".$mySQLi->real_escape_string($this->Active)."', MapImage = '".$mySQLi->real_escape_string($this->MapImage)."', Featured = '".$mySQLi->real_escape_string($this->Featured)."', Bedroom = '".$mySQLi->real_escape_string($this->Bedroom)."', Platfond = '".$mySQLi->real_escape_string($this->Platfond)."', Roof = '".$mySQLi->real_escape_string($this->Roof)."', Bathroom = '".$mySQLi->real_escape_string($this->Bathroom)."', Foundation = '".$mySQLi->real_escape_string($this->Foundation)."', MainDoor = '".$mySQLi->real_escape_string($this->MainDoor)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Floor = '".$mySQLi->real_escape_string($this->Floor)."', Window = '".$mySQLi->real_escape_string($this->Window)."', RoofFrame = '".$mySQLi->real_escape_string($this->RoofFrame)."', MinPrice = '".$mySQLi->real_escape_string($this->MinPrice)."', Wall = '".$mySQLi->real_escape_string($this->Wall)."', Title = '".$mySQLi->real_escape_string($this->Title)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_NewPropertyMarketing($page=0,$totalitem=0){
       return NewPropertyMarketing::LoadCollection($this->get_mySQLi(),"NewProperty = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_NewPropertyImage($page=0,$totalitem=0){
       return NewPropertyImage::LoadCollection($this->get_mySQLi(),"NewProperty = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_NewPropertyFacility($page=0,$totalitem=0){
       return NewPropertyFacility::LoadCollection($this->get_mySQLi(),"NewProperty = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpNewProperty = new NewProperty($mySQLi);
               $tmpNewProperty->Id = $row['Id'];
               $tmpNewProperty->Description = $row['Description'];
               $tmpNewProperty->Currency = $row['Currency'];
               $tmpNewProperty->MaxPrice = $row['MaxPrice'];
               $tmpNewProperty->Active = $row['Active'];
               $tmpNewProperty->MapImage = $row['MapImage'];
               $tmpNewProperty->Featured = $row['Featured'];
               $tmpNewProperty->Bedroom = $row['Bedroom'];
               $tmpNewProperty->Platfond = $row['Platfond'];
               $tmpNewProperty->Roof = $row['Roof'];
               $tmpNewProperty->Bathroom = $row['Bathroom'];
               $tmpNewProperty->Foundation = $row['Foundation'];
               $tmpNewProperty->MainDoor = $row['MainDoor'];
               $tmpNewProperty->Location = $row['Location'];
               $tmpNewProperty->Floor = $row['Floor'];
               $tmpNewProperty->Window = $row['Window'];
               $tmpNewProperty->RoofFrame = $row['RoofFrame'];
               $tmpNewProperty->MinPrice = $row['MinPrice'];
               $tmpNewProperty->Wall = $row['Wall'];
               $tmpNewProperty->Title = $row['Title'];

               $tmpNewProperty->LockField = $row['LockField'];
               return $tmpNewProperty;
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
           $NewPropertys = array();
           while ($row = $result->fetch_array()){
               $tmpNewProperty = new NewProperty($mySQLi);
               $tmpNewProperty->Id = $row['Id'];
               $tmpNewProperty->LockField = $row['LockField'];
               $tmpNewProperty->Description = $row['Description'];
               $tmpNewProperty->Currency = $row['Currency'];
               $tmpNewProperty->MaxPrice = $row['MaxPrice'];
               $tmpNewProperty->Active = $row['Active'];
               $tmpNewProperty->MapImage = $row['MapImage'];
               $tmpNewProperty->Featured = $row['Featured'];
               $tmpNewProperty->Bedroom = $row['Bedroom'];
               $tmpNewProperty->Platfond = $row['Platfond'];
               $tmpNewProperty->Roof = $row['Roof'];
               $tmpNewProperty->Bathroom = $row['Bathroom'];
               $tmpNewProperty->Foundation = $row['Foundation'];
               $tmpNewProperty->MainDoor = $row['MainDoor'];
               $tmpNewProperty->Location = $row['Location'];
               $tmpNewProperty->Floor = $row['Floor'];
               $tmpNewProperty->Window = $row['Window'];
               $tmpNewProperty->RoofFrame = $row['RoofFrame'];
               $tmpNewProperty->MinPrice = $row['MinPrice'];
               $tmpNewProperty->Wall = $row['Wall'];
               $tmpNewProperty->Title = $row['Title'];

               $NewPropertys[] = $tmpNewProperty;
           }
           return $NewPropertys;
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