<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/iCheck/square/blue.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-box-body">
        <form action="<?php echo base_url();?>index.php/login/login" method="post">
          <p class="text-red" id="error"></p>
          <div class="form-group has-feedback">
            <input name="username" class="form-control" placeholder="ISBN">
            <span class="glyphicon glyphicon-book form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="密码">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <!--<input type="checkbox"> Remember Me-->
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">借阅</button>
            </div><!-- /.col -->
          </div>
        </form>       
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    <script>
      $(function() 
        {
            $('input').iCheck({
            checkboxClass:'icheckbox_square-blue',
            radioClass:'iradio_square-blue',
            increaseArea:'20%' // optional
            });
        });
    </script>
  </body>
  
</html>
