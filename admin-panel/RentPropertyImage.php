<?php include_once('ValidateSession.php') ?>
<?php
include_once('Classes/RentProperty.php');
include_once('Classes/RentPropertyImage.php');

$RentPropertyId = $_GET['Id'];

$Conn = Connection::get_DefaultConnection();
$RentPropertyImages = RentPropertyImage::LoadCollection($Conn, 'RentProperty ='.$RentPropertyId);

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

        <link rel="stylesheet" href="js/lib/colorbox/colorbox.css">
        <link rel="stylesheet" href="js/lib/fullcalendar/fullcalendar_beoro.css">

        <link rel="stylesheet" href="css/beoro.css">
        <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">

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
                        <h4>Rent Property Image</h4>
                                
                        <div class="w-box">
                            <div class="w-box-header">
                                <a href="RentProperty.php" class="btn btn-inverse btn-mini" title="View">Back to Rent Property</a>
                                <a href="AddRentPropertyImage.php?RentPropertyId=<?php echo $RentPropertyId ?>" class="btn btn-inverse btn-mini" title="View">New RentPropertyImage</a>
                            </div>
                            <div class="w-box-content">
                                <table id="dt_hScroll" class="dataTables_full table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $counter = 0;
                                            foreach ($RentPropertyImages as $RentPropertyImage) {
                                            $Id = $RentPropertyImage->get_Id();
                                            $RentPropertyImage_RentProperty = $RentPropertyImage->RentProperty;
                                            $RentProperty = RentProperty::GetObjectByKey($Conn, $RentPropertyImage_RentProperty);
                                            $RentPropertyImage_RentProperty = $RentProperty->Title;
                                            $ImageName = $RentPropertyImage->ImageName;
                                            $Active = $RentPropertyImage->Active;
                                            if ($RentPropertyImage->Active == 1){$Active = "Active";}else{$Active = "InActive";}
                                                $counter++;

                                                echo "<tr>";
                                                echo "<td style='width:10px'>".$counter."</td>";
                                                echo "<td style='width:60px'><img alt='' src='../images/RentPropertys/".$ImageName."' style='height:50px;width:50px'></td>";
                                                echo "<td>".$Active."</td>";
                                                echo '
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="ProcessDeleteRentPropertyImage.php?Id='.$Id.'&RentPropertyId='.$RentPropertyId.'" class="btn btn-mini" title="Delete"><i class="icon-trash"></i></a>
                                                        </div>
                                                    </td>
                                                ';
                                                echo "</tr>";
                                            }
                                        ?>
                                     </tbody>
                                </table>
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

    </body>
</html>