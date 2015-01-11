<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="icon" type="image/ico" href="favicon.ico">
    <title>ipropertyBatam Dashboard - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet'>
    <!-- jQuery framework -->
        <script src="js/jquery.min.js"></script>
    <!-- validation -->
        <script src="js/lib/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript">
        (function(a){a.fn.vAlign=function(){return this.each(function(){var b=a(this).height(),c=a(this).outerHeight(),b=(b+(c-b))/2;a(this).css("margin-top","-"+b+"px");a(this).css("top","50%");a(this).css("position","absolute")})}})(jQuery);(function(a){a.fn.hAlign=function(){return this.each(function(){var b=a(this).width(),c=a(this).outerWidth(),b=(b+(c-b))/2;a(this).css("margin-left","-"+b+"px");a(this).css("left","50%");a(this).css("position","absolute")})}})(jQuery);
        $(document).ready(function() {
            if($('#login-wrapper').length) {
                $("#login-wrapper").vAlign().hAlign()
            };
            if($('#login-validate').length) {
                $('#login-validate').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    rules: {
                        login_name: { required: true },
                        login_password: { required: true }
                    }
                })
            }
           
            $('#pass_login').click(function() {
                $('.panel:visible').slideUp('200',function() {
                    $('.panel').not($(this)).slideDown('200');
                });
                $(this).children('span').toggle();
            });
        });
    </script>
</head>
<body>
    <div id="login-wrapper" class="clearfix">
        <div class="main-col">
            <img src="../images/logo_icon.png" alt="" class="logo_img" />
            <div class="panel">
                <p class="heading_main">iPropertyBatam Dashboard Login</p>
                <form id="login-validate" action="processlogin.php" method="post">
                    <label for="login_name">Login</label>
                    <input type="text" id="login_name" name="login_name" value="" />
                    <label for="login_password">Password</label>
                    <input type="password" id="login_password" name="login_password" value="" />
                    <div class="submit_sect">
                        <button type="submit" class="btn btn-beoro-3">Login</button>
                    </div>
                </form>
            </div>
            
        </div>
       
    </div>
</body>
</html>