<?php include_once('ValidateSession.php') ?>
<?php
include_once('Classes/Connection.php');
include_once('Classes/SecondaryProperty.php');
include_once('Classes/Currency.php');
include_once('Classes/Location.php');
include_once('Classes/User.php');

$Conn = Connection::get_DefaultConnection();

$Id = $_GET['Id']; 

$SecondaryProperty = SecondaryProperty::GetObjectByKey($Conn, $Id);
$Title = $SecondaryProperty->Title;
    $Description = $SecondaryProperty->Description;
    $SecondaryProperty_Currency = $SecondaryProperty->Currency;
    $Price = $SecondaryProperty->Price;
    $SecondaryProperty_Location = $SecondaryProperty->Location;
    $Bedroom = $SecondaryProperty->Bedroom;
    $Bathroom = $SecondaryProperty->Bathroom;
    $Deposit = $SecondaryProperty->Deposit;
    $TimeRange = $SecondaryProperty->Periods;
    $EstimatedInterestRate = $SecondaryProperty->EstimatedInterestRate;
    $LandArea = $SecondaryProperty->LandArea;
    $BuildingArea = $SecondaryProperty->BuildingArea;
    $FunitureIncluded = $SecondaryProperty->FunitureIncluded;
    $Certificate = $SecondaryProperty->Certificate;
    $SecondaryProperty_Marketing = $SecondaryProperty->Marketing;
    $Featured = $SecondaryProperty->Featured;
    $Active = $SecondaryProperty->Active;
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>

        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <link rel="icon" type="image/ico" href="favicon.ico">
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="img/icsw2_16/icsw2_16.css">
        <link rel="stylesheet" href="img/splashy/splashy.css">
        <link rel="stylesheet" href="img/flags/flags.css">
        <link rel="stylesheet" href="js/lib/powertip/jquery.powertip.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Abel">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">
        <link rel="stylesheet" href="js/lib/ibutton/css/jquery.ibutton.css">
        <link rel="stylesheet" href="js/lib/colorbox/colorbox.css">
        <link rel="stylesheet" href="js/lib/fullcalendar/fullcalendar_beoro.css">

        <link rel="stylesheet" href="css/beoro.css">
        <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
        <link rel="stylesheet" href="js/lib/bootstrap-datepicker/css/datepicker.css">

        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css"><![endif]-->
        <!--[if IE 9]><link rel="stylesheet" href="css/ie9.css"><![endif]-->
            
        <!--[if lt IE 9]>
            <script src="js/ie/html5shiv.min.js"></script>
            <script src="js/ie/respond.min.js"></script>
            <script src="js/lib/flot-charts/excanvas.min.js"></script>
        <![endif]-->

    </head>
    <body class="bg_d">
    <!-- main wrapper (without footer) -->    
        <div class="main-wrapper">
        <!-- top bar -->
            <?php include_once('navigation.php'); ?>

        <!-- header -->
            <?php include_once('header.php'); ?>

        
        <!-- main content -->
            <div class="container">
                <div class="row-fluid"></div>
                <div class="row-fluid">
                    <div class="span12">
                        <h4>Add Secondary Property</h4>
                              
                    	<div class="w-box" id="n_fileupload">
                            <div class="w-box-header">
                                <h4><a href="SecondaryProperty.php" class="btn btn-inverse btn-mini">Back to SecondaryProperty</a></h4>
                            </div>
                            <div class="w-box-content">
                                <form id="validate_field_types" method="post" action="ProcessAddSecondaryProperty.php" enctype="multipart/form-data">
	                                
                                    <div class="formSep">
                                        <label class="req">Title</label>
                                        <input required class="span10" type="text" name="Title" id="Title" value="<?php echo $Title; ?>" />
                                    </div>

                                    <div class="formSep">
                                        <label class="req">Description</label>
                                        <Textarea class="span10 autosize_textarea" cols="70" rows="3" name="Description" id="Description"><?php echo $Description; ?></Textarea>
                                    </div>

                                    <div class="formSep">
                                        <label class="req">Currency</label>
                                        <select class="span10" name="Currency" id="Currency">
                                            <?php
                                                $Currencys = Currency::LoadCollection($Conn);
                                                foreach ($Currencys as $Currency) {
                                                    if($SecondaryProperty_Currency==$Currency->get_Id()){
                                                        $isSelected = 'selected';
                                                    }else{
                                                        $isSelected = '';
                                                    }
                                                    echo "<option value=". $Currency->get_Id() ." ".  $isSelected .">". $Currency->Code ."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="formSep">
                                        <label class="req">Price</label>
                                        <input class="span10" type="text" name="Price" id="Price" value="<?php echo $Price; ?>" />
                                    </div>

                                    <div class="formSep">
                                        <label class="req">Location</label>
                                        <select class="span10" name="Location" id="Location">
                                            <?php
                                                $Locations = Location::LoadCollection($Conn);
                                                foreach ($Locations as $Location) {
                                                    if($SecondaryProperty_Location==$Location->get_Id()){
                                                        $isSelected = 'selected';
                                                    }else{
                                                        $isSelected = '';
                                                    }
                                                    echo "<option value=". $Location->get_Id() ." ".  $isSelected .">". $Location->Name ."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="formSep">
                                        <div class="span3">
                                            <label class="req">Bedroom</label>
                                            <input type="text" class="span12" name="Bedroom" id="Bedroom" value="<?php echo $Bedroom; ?>" />
                                        </div>
                                        <div class="span3">
                                            <label class="req">Bathroom</label>
                                            <input type="text" class="span12" name="Bathroom" id="Bathroom" value="<?php echo $Bathroom; ?>" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div class="span3">
                                            <label class="req">Land Area</label>
                                            <input type="text" class="span12" name="LandArea" id="LandArea" value="<?php echo $LandArea; ?>" />
                                        </div>
                                        <div class="span3">
                                            <label class="req">Building Area</label>
                                            <input type="text" class="span12" name="BuildingArea" id="BuildingArea" value="<?php echo $BuildingArea; ?>" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div class="span3">
                                            <label class="req">Deposit</label>
                                            <input type="text" class="span12" name="Deposit" id="Deposit" value="<?php echo $Deposit; ?>" />
                                        </div>
                                        <div class="span3">
                                            <label class="req">TimeRange</label>
                                            <input type="text" class="span12" name="TimeRange" id="TimeRange" value="<?php echo $TimeRange; ?>" />
                                        </div>
                                         <div class="span3">
                                            <label class="req">EstimatedInterestRate</label>
                                            <input type="text" class="span12" name="EstimatedInterestRate" id="EstimatedInterestRate" value="<?php echo $EstimatedInterestRate; ?>" />
                                        </div>
                                    </div>

                                     <div class="formSep" style="min-height: 50px;">
                                        
                                        <div class="span3">
                                            <label>Funiture Included</label>
                                            <input type="checkbox" name="FunitureIncluded" <?php if($FunitureIncluded==1){echo "Checked";}else{echo "";} ?> />
                                            
                                        </div>
                                        <div class="span8">
                                            <label class="req">Certificate</label>
                                            <input type="text" class="span8" name="Certificate" id="Certificate" value="<?php echo $Certificate; ?>" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <label class="req">Marketing</label>
                                        <select class="span10" name="Marketing" id="Marketing">
                                           <?php
                                                $Marketings = User::LoadCollection($Conn, "UserType IN (1,3)");
                                                foreach ($Marketings as $Marketing) {
                                                    if($SecondaryProperty_Marketing==$Marketing->get_Id()){
                                                        $isSelected = 'selected';
                                                    }else{
                                                        $isSelected = '';
                                                    }
                                                    echo "<option value=". $Marketing->get_Id() ." ".  $isSelected .">". $Marketing->Name ."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="formSep" style="min-height: 50px;">
                                        
                                        <div class="span3">
                                            <label>Featured</label>
                                            <input type="checkbox" name="Featured" <?php if($Featured==1){echo "Checked";}else{echo "";} ?>/>
                                        </div>
                                        <div class="span3">
                                            <label>Active</label>
                                            <input type="checkbox" name="Active" <?php if($Active==1){echo "Checked";}else{echo "";} ?>/>
                                        </div>
                                        
                                    </div>


	                                <div class="formSep">
                                        <button type="submit" class="btn">Save</button>
                                    </div>
                            	</form>
                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer_space"></div>
        </div> 

    <!-- footer --> 
        <footer>
            <div class="container">
                <div class="row">
                    <div class="span5">
                        <div>&copy; iPropertyBatam</div>
                    </div>
                    
                </div>
            </div>
        </footer>
        
    <!-- Common JS -->
        <!-- jQuery framework -->
            <script src="js/jquery.min.js"></script>
            <script src="js/form/bootstrap-fileupload.min.js"></script>

           

        <!-- bootstrap Framework plugins -->
            <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- top menu -->
            <script src="js/jquery.fademenu.js"></script>
        <!-- top mobile menu -->
            <script src="js/selectnav.min.js"></script>
        <!-- actual width/height of hidden DOM elements -->
            <script src="js/jquery.actual.min.js"></script>
        <!-- jquery easing animations -->
            <script src="js/jquery.easing.1.3.min.js"></script>
        <!-- power tooltips -->
            <script src="js/lib/powertip/jquery.powertip-1.1.0.min.js"></script>
        <!-- date library -->
            <script src="js/moment.min.js"></script>
        <!-- common functions -->
            <script src="js/beoro_common.js"></script>


             <script src="js/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
             
        
    <!-- Dashboard JS -->
        <!-- jQuery UI -->
            <script src="js/lib/jquery-ui/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- touch event support for jQuery UI -->
            <script src="js/lib/jquery-ui/jquery.ui.touch-punch.min.js"></script>
        <!-- colorbox -->
            <script src="js/lib/colorbox/jquery.colorbox.min.js"></script>
        <!-- fullcalendar -->
            <script src="js/lib/fullcalendar/fullcalendar.min.js"></script>
        <!-- flot charts -->
            <script src="js/lib/flot-charts/jquery.flot.js"></script>
            <script src="js/lib/flot-charts/jquery.flot.resize.js"></script>
            <script src="js/lib/flot-charts/jquery.flot.pie.js"></script>
            <script src="js/lib/flot-charts/jquery.flot.orderBars.js"></script>
            <script src="js/lib/flot-charts/jquery.flot.tooltip.js"></script>
            <script src="js/lib/flot-charts/jquery.flot.time.js"></script>
        <!-- responsive carousel -->
            <script src="js/lib/carousel/plugin.min.js"></script>
        <!-- responsive image grid -->
            <script src="js/lib/wookmark/jquery.imagesloaded.min.js"></script>
            <script src="js/lib/wookmark/jquery.wookmark.min.js"></script>
<script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
        <!-- datatables column reorder -->
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
        <!-- datatables column toggle visibility -->
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
        <!-- datatable table tools -->
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
        <!-- datatables bootstrap integration -->
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>

            <script src="js/pages/beoro_datatables.js"></script>
            <script src="js/pages/beoro_dashboard.js"></script>
          <script src="js/pages/beoro_tables.js"></script>
          <script src="js/lib/ckeditor/ckeditor.js"></script>

            <script src="js/pages/beoro_form_elements.js"></script>

            <!-- jQuery UI -->
            <script src="js/lib/jquery-ui/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- touch event support for jQuery UI -->
            <script src="js/lib/jquery-ui/jquery.ui.touch-punch.min.js"></script>
        <!-- progressbar animations -->
            <script src="js/form/jquery.progressbar.anim.min.js"></script>
        <!-- 2col multiselect -->
            <script src="js/lib/multi-select/js/jquery.multi-select.min.js"></script>
            <script src="js/lib/multi-select/js/jquery.quicksearch.min.js"></script>
        <!-- combobox -->
            <script src="js/form/fuelux.combobox.min.js"></script>
        <!-- file upload widget -->
            <script src="js/form/bootstrap-fileupload.min.js"></script>
        <!-- masked inputs -->
            <script src="js/lib/jquery-inputmask/jquery.inputmask.min.js"></script>
            <script src="js/lib/jquery-inputmask/jquery.inputmask.extensions.js"></script>
            <script src="js/lib/jquery-inputmask/jquery.inputmask.date.extensions.js"></script>
        <!-- enchanced select box, tag handler -->
            <script src="js/lib/select2/select2.min.js"></script>
        <!-- password strength metter -->
            <script src="js/lib/pwdMeter/jquery.pwdMeter.min.js"></script>
        <!-- datepicker -->
            <script src="js/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
      
            <script src="js/lib/ckeditor/ckeditor.js"></script>

            <script src="js/pages/beoro_form_elements.js"></script>
            <script src="js/form/jquery.autosize.min.js"></script>
            <script src="js/lib/ibutton/js/jquery.ibutton.beoro.min.js"></script>
            <script type="text/javascript">

				$(document).ready(function (){
				  $(":checkbox").iButton();
				});
				
            </script>
    </body>
</html>