<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Marketing extends BaseObject{
   const TABLENAME = 'Marketing';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $ContactNumber2;
    public $Active;
    public $ContactNumber1;
    public $UploadLimit;
    public $UserName;
    public $ProfilePicture;
    public $Name;
    public $Password;
    public $Email;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(ContactNumber2,Active,ContactNumber1,UploadLimit,UserName,ProfilePicture,Name,Password,Email,LockField) VALUES('".$mySQLi->real_escape_string($this->ContactNumber2)."','".$mySQLi->real_escape_string($this->Active)."','".$mySQLi->real_escape_string($this->ContactNumber1)."','".$mySQLi->real_escape_string($this->UploadLimit)."','".$mySQLi->real_escape_string($this->UserName)."','".$mySQLi->real_escape_string($this->ProfilePicture)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Password)."','".$mySQLi->real_escape_string($this->Email)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET ContactNumber2 = '".$mySQLi->real_escape_string($this->ContactNumber2)."', Active = '".$mySQLi->real_escape_string($this->Active)."', ContactNumber1 = '".$mySQLi->real_escape_string($this->ContactNumber1)."', UploadLimit = '".$mySQLi->real_escape_string($this->UploadLimit)."', UserName = '".$mySQLi->real_escape_string($this->UserName)."', ProfilePicture = '".$mySQLi->real_escape_string($this->ProfilePicture)."', Name = '".$mySQLi->real_escape_string($this->Name)."', Password = '".$mySQLi->real_escape_string($this->Password)."', Email = '".$mySQLi->real_escape_string($this->Email)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_Land($page=0,$totalitem=0){
       return Land::LoadCollection($this->get_mySQLi(),"Marketing = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_SecondaryProperty($page=0,$totalitem=0){
       return SecondaryProperty::LoadCollection($this->get_mySQLi(),"Marketing = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_NewPropertyMarketing($page=0,$totalitem=0){
       return NewPropertyMarketing::LoadCollection($this->get_mySQLi(),"Marketing = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpMarketing = new Marketing($mySQLi);
               $tmpMarketing->Id = $row['Id'];
               $tmpMarketing->ContactNumber2 = $row['ContactNumber2'];
               $tmpMarketing->Active = $row['Active'];
               $tmpMarketing->ContactNumber1 = $row['ContactNumber1'];
               $tmpMarketing->UploadLimit = $row['UploadLimit'];
               $tmpMarketing->UserName = $row['UserName'];
               $tmpMarketing->ProfilePicture = $row['ProfilePicture'];
               $tmpMarketing->Name = $row['Name'];
               $tmpMarketing->Password = $row['Password'];
               $tmpMarketing->Email = $row['Email'];

               $tmpMarketing->LockField = $row['LockField'];
               return $tmpMarketing;
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
           $Marketings = array();
           while ($row = $result->fetch_array()){
               $tmpMarketing = new Marketing($mySQLi);
               $tmpMarketing->Id = $row['Id'];
               $tmpMarketing->LockField = $row['LockField'];
               $tmpMarketing->ContactNumber2 = $row['ContactNumber2'];
               $tmpMarketing->Active = $row['Active'];
               $tmpMarketing->ContactNumber1 = $row['ContactNumber1'];
               $tmpMarketing->UploadLimit = $row['UploadLimit'];
               $tmpMarketing->UserName = $row['UserName'];
               $tmpMarketing->ProfilePicture = $row['ProfilePicture'];
               $tmpMarketing->Name = $row['Name'];
               $tmpMarketing->Password = $row['Password'];
               $tmpMarketing->Email = $row['Email'];

               $Marketing[] = $tmpMarketing;
           }
           return $Marketings;
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