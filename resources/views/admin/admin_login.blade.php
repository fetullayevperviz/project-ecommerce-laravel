<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel Login</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{asset('/admin_assets/')}}/dist/img/ico/favicon.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="{{asset('/admin_assets/')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="{{asset('/admin_assets/')}}/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <!-- style css -->
    <link href="{{asset('/admin_assets/')}}/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
     @toastr_css
</head>
<body style="background-color:#008B8B !important;">
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center">
            @if(Session::has('flash_message_error'))
              <div class="alert alert-sm alert-danger alert-block" role='alert' style="text-align:center;">
                  <button type="button" class="close" data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span></button>
                  <strong>{!! session('flash_message_error') !!}</strong>
              </div>
            @endif
            @if(Session::has('flash_message_success'))
              <div class="alert alert-sm alert-success alert-block" role='alert' style="text-align:center;">
                  <button type="button" class="close" data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span></button>
                  <strong>{!! session('flash_message_success') !!}</strong>
              </div>
            @endif
        <div class="login-area">
            <div class="panel panel-bd panel-custom">
                <div class="panel-heading">
                    <div class="view-header">
                        <div style="text-align:center;">
                            <h3>Giriş Formu</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{url('admin')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Email adresinizi yazın" required name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" required class="form-control" placeholder="Şifrənizi yazın">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" style="float:right;">Daxil ol</button>
                        </div>
                    </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="{{asset('/admin_assets/')}}/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="{{asset('/admin_assets/')}}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    @toastr_js
    @toastr_render
</body>
</html>