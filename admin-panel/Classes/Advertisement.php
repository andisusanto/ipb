<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Advertisement extends BaseObject{
   const TABLENAME = 'Advertisement';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $ShowOnLandForSaleListing;
    public $ShowOnRentPropertyListing;
    public $DueDate;
    public $Active;
    public $ShowOnContact;
    public $ShowOnSecondaryPropertyListing;
    public $Link;
    public $ImageName;
    public $ShowOnHome;
    public $ShowOnNewPropertyListing;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(ShowOnLandForSaleListing,ShowOnRentPropertyListing,DueDate,Active,ShowOnContact,ShowOnSecondaryPropertyListing,Link,ImageName,ShowOnHome,ShowOnNewPropertyListing,LockField) VALUES('".$mySQLi->real_escape_string($this->ShowOnLandForSaleListing)."','".$mySQLi->real_escape_string($this->ShowOnRentPropertyListing)."','".$mySQLi->real_escape_string($this->DueDate)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->ShowOnContact)."','".$mySQLi->real_escape_string($this->ShowOnSecondaryPropertyListing)."','".$mySQLi->real_escape_string($this->Link)."','".$mySQLi->real_escape_string($this->ImageName)."','".$mySQLi->real_escape_string($this->ShowOnHome)."','".$mySQLi->real_escape_string($this->ShowOnNewPropertyListing)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET ShowOnLandForSaleListing = '".$mySQLi->real_escape_string($this->ShowOnLandForSaleListing)."', ShowOnRentPropertyListing = '".$mySQLi->real_escape_string($this->ShowOnRentPropertyListing)."', DueDate = '".$mySQLi->real_escape_string($this->DueDate)."', Active = '".$mySQLi->real_escape_string($this->Active)."', ShowOnContact = '".$mySQLi->real_escape_string($this->ShowOnContact)."', ShowOnSecondaryPropertyListing = '".$mySQLi->real_escape_string($this->ShowOnSecondaryPropertyListing)."', Link = '".$mySQLi->real_escape_string($this->Link)."', ImageName = '".$mySQLi->real_escape_string($this->ImageName)."', ShowOnHome = '".$mySQLi->real_escape_string($this->ShowOnHome)."', ShowOnNewPropertyListing = '".$mySQLi->real_escape_string($this->ShowOnNewPropertyListing)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpAdvertisement = new Advertisement($mySQLi);
               $tmpAdvertisement->Id = $row['Id'];
               $tmpAdvertisement->ShowOnLandForSaleListing = $row['ShowOnLandForSaleListing'];
               $tmpAdvertisement->ShowOnRentPropertyListing = $row['ShowOnRentPropertyListing'];
               $tmpAdvertisement->DueDate = $row['DueDate'];
               $tmpAdvertisement->Active = $row['Active'];
               $tmpAdvertisement->ShowOnContact = $row['ShowOnContact'];
               $tmpAdvertisement->ShowOnSecondaryPropertyListing = $row['ShowOnSecondaryPropertyListing'];
               $tmpAdvertisement->Link = $row['Link'];
               $tmpAdvertisement->ImageName = $row['ImageName'];
               $tmpAdvertisement->ShowOnHome = $row['ShowOnHome'];
               $tmpAdvertisement->ShowOnNewPropertyListing = $row['ShowOnNewPropertyListing'];

               $tmpAdvertisement->LockField = $row['LockField'];
               return $tmpAdvertisement;
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
           $Advertisements = array();
           while ($row = $result->fetch_array()){
               $tmpAdvertisement = new Advertisement($mySQLi);
               $tmpAdvertisement->Id = $row['Id'];
               $tmpAdvertisement->LockField = $row['LockField'];
               $tmpAdvertisement->ShowOnLandForSaleListing = $row['ShowOnLandForSaleListing'];
               $tmpAdvertisement->ShowOnRentPropertyListing = $row['ShowOnRentPropertyListing'];
               $tmpAdvertisement->DueDate = $row['DueDate'];
               $tmpAdvertisement->Active = $row['Active'];
               $tmpAdvertisement->ShowOnContact = $row['ShowOnContact'];
               $tmpAdvertisement->ShowOnSecondaryPropertyListing = $row['ShowOnSecondaryPropertyListing'];
               $tmpAdvertisement->Link = $row['Link'];
               $tmpAdvertisement->ImageName = $row['ImageName'];
               $tmpAdvertisement->ShowOnHome = $row['ShowOnHome'];
               $tmpAdvertisement->ShowOnNewPropertyListing = $row['ShowOnNewPropertyListing'];

               $Advertisements[] = $tmpAdvertisement;
           }
           return $Advertisements;
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