<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Land extends BaseObject{
   const TABLENAME = 'Land';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Title;
    public $Category;
    public $Featured;
    public $Marketing;
    public $MapImage;
    public $Certificate;
    public $Location;
    public $Currency;
    public $LandType;
    public $Size;
    public $Price;
    public $Description;
    public $Active;
    public $WTO;
    public $Area;
    public $Conditions;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Title,Category,Featured,Marketing,MapImage,Certificate,Location,Currency,LandType,Size,Price,Description,Active,WTO,Area,Conditions,LockField) VALUES('".$mySQLi->real_escape_string($this->Title)."','".$mySQLi->real_escape_string($this->Category)."','".$mySQLi->real_escape_string($this->Featured)."','".$mySQLi->real_escape_string($this->Marketing)."','".$mySQLi->real_escape_string($this->MapImage)."','".$mySQLi->real_escape_string($this->Certificate)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Currency)."','".$mySQLi->real_escape_string($this->LandType)."','".$mySQLi->real_escape_string($this->Size)."','".$mySQLi->real_escape_string($this->Price)."','".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->WTO)."','".$mySQLi->real_escape_string($this->Area)."','".$mySQLi->real_escape_string($this->Conditions)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Title = '".$mySQLi->real_escape_string($this->Title)."', Category = '".$mySQLi->real_escape_string($this->Category)."', Featured = '".$mySQLi->real_escape_string($this->Featured)."', Marketing = '".$mySQLi->real_escape_string($this->Marketing)."', MapImage = '".$mySQLi->real_escape_string($this->MapImage)."', Certificate = '".$mySQLi->real_escape_string($this->Certificate)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Currency = '".$mySQLi->real_escape_string($this->Currency)."', LandType = '".$mySQLi->real_escape_string($this->LandType)."', Size = '".$mySQLi->real_escape_string($this->Size)."', Price = '".$mySQLi->real_escape_string($this->Price)."', Description = '".$mySQLi->real_escape_string($this->Description)."', Active = '".$mySQLi->real_escape_string($this->Active)."', WTO = '".$mySQLi->real_escape_string($this->WTO)."', Area = '".$mySQLi->real_escape_string($this->Area)."', Conditions = '".$mySQLi->real_escape_string($this->Conditions)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_LandImage($page=0,$totalitem=0){
       return LandImage::LoadCollection($this->get_mySQLi(),"Land = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpLand = new Land($mySQLi);
               $tmpLand->Id = $row['Id'];
               $tmpLand->Title = $row['Title'];
               $tmpLand->Category = $row['Category'];
               $tmpLand->Featured = $row['Featured'];
               $tmpLand->Marketing = $row['Marketing'];
               $tmpLand->MapImage = $row['MapImage'];
               $tmpLand->Certificate = $row['Certificate'];
               $tmpLand->Location = $row['Location'];
               $tmpLand->Currency = $row['Currency'];
               $tmpLand->LandType = $row['LandType'];
               $tmpLand->Size = $row['Size'];
               $tmpLand->Price = $row['Price'];
               $tmpLand->Description = $row['Description'];
               $tmpLand->Active = $row['Active'];
               $tmpLand->WTO = $row['WTO'];
               $tmpLand->Area = $row['Area'];
               $tmpLand->Conditions = $row['Conditions'];

               $tmpLand->LockField = $row['LockField'];
               return $tmpLand;
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
           $Lands = array();
           while ($row = $result->fetch_array()){
               $tmpLand = new Land($mySQLi);
               $tmpLand->Id = $row['Id'];
               $tmpLand->LockField = $row['LockField'];
               $tmpLand->Title = $row['Title'];
               $tmpLand->Category = $row['Category'];
               $tmpLand->Featured = $row['Featured'];
               $tmpLand->Marketing = $row['Marketing'];
               $tmpLand->MapImage = $row['MapImage'];
               $tmpLand->Certificate = $row['Certificate'];
               $tmpLand->Location = $row['Location'];
               $tmpLand->Currency = $row['Currency'];
               $tmpLand->LandType = $row['LandType'];
               $tmpLand->Size = $row['Size'];
               $tmpLand->Price = $row['Price'];
               $tmpLand->Description = $row['Description'];
               $tmpLand->Active = $row['Active'];
               $tmpLand->WTO = $row['WTO'];
               $tmpLand->Area = $row['Area'];
               $tmpLand->Conditions = $row['Conditions'];

               $Lands[] = $tmpLand;
           }
           return $Lands;
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