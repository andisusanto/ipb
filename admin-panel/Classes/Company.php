<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Company extends BaseObject{
   const TABLENAME = 'Company';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Telephone;
    public $Faximile;
    public $MapImage;
    public $Picture;
    public $Name;
    public $FacebookAccount;
    public $Address;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Telephone,Faximile,MapImage,Picture,Name,FacebookAccount,Address,LockField) VALUES('".$mySQLi->real_escape_string($this->Telephone)."','".$mySQLi->real_escape_string($this->Faximile)."','".$mySQLi->real_escape_string($this->MapImage)."','".$mySQLi->real_escape_string($this->Picture)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->FacebookAccount)."','".$mySQLi->real_escape_string($this->Address)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Telephone = '".$mySQLi->real_escape_string($this->Telephone)."', Faximile = '".$mySQLi->real_escape_string($this->Faximile)."', MapImage = '".$mySQLi->real_escape_string($this->MapImage)."', Picture = '".$mySQLi->real_escape_string($this->Picture)."', Name = '".$mySQLi->real_escape_string($this->Name)."', FacebookAccount = '".$mySQLi->real_escape_string($this->FacebookAccount)."', Address = '".$mySQLi->real_escape_string($this->Address)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpCompany = new Company($mySQLi);
               $tmpCompany->Id = $row['Id'];
               $tmpCompany->Telephone = $row['Telephone'];
               $tmpCompany->Faximile = $row['Faximile'];
               $tmpCompany->MapImage = $row['MapImage'];
               $tmpCompany->Picture = $row['Picture'];
               $tmpCompany->Name = $row['Name'];
               $tmpCompany->FacebookAccount = $row['FacebookAccount'];
               $tmpCompany->Address = $row['Address'];

               $tmpCompany->LockField = $row['LockField'];
               return $tmpCompany;
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
           $Companys = array();
           while ($row = $result->fetch_array()){
               $tmpCompany = new Company($mySQLi);
               $tmpCompany->Id = $row['Id'];
               $tmpCompany->LockField = $row['LockField'];
               $tmpCompany->Telephone = $row['Telephone'];
               $tmpCompany->Faximile = $row['Faximile'];
               $tmpCompany->MapImage = $row['MapImage'];
               $tmpCompany->Picture = $row['Picture'];
               $tmpCompany->Name = $row['Name'];
               $tmpCompany->FacebookAccount = $row['FacebookAccount'];
               $tmpCompany->Address = $row['Address'];

               $Companys[] = $tmpCompany;
           }
           return $Companys;
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