<?php include_once('ValidationAdmin.php'); ?>
<?php include_once('GlobalVar.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php include_once('Connection.php'); ?>
<?php include_once('BannerPhoto.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
    try{
        if ($_FILES["bannerphoto"]["error"] > 0)
          {
                throw new FileUploadException();
          }
        else
          {
                $extension = GlobalFunction::getFileExtension($_FILES["bannerphoto"]["name"]);
                if(GlobalFunction::IsAllowedPhotoExtension($extension)){
                    $path = GlobalVar::UPLOAD.GlobalVar::IMAGE.BannerPhoto::PHOTODIRECTORY;
                    $mySQLi = Connection::get_DefaultConnection();
                    $bannerphoto = new BannerPhoto($mySQLi);
                    $bannerphoto->IsActive = $_POST['chkstatus'];
                    $bannerphoto->Extension = $extension;
                    $bannerphoto->Save();
                    $path .= $bannerphoto->get_PhotoName();
                    if(move_uploaded_file($_FILES["bannerphoto"]["tmp_name"],$path)){
                        $mySQLi->commit();
                        header('location:adminindex.php');
                    }   
                }else{
                    throw new FileExtensionMismatch();
                }
          }
        
    }catch(Exception $ex){
        include('ErrorHandler.php');
    }


?>
