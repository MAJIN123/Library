<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
<!-- Chat box -->
<div class="box box-success">
<div class="box-header">
    <i class="fa fa-comments-o"></i>
    <h3 class="box-title">Chat</h3>
    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
    <div class="btn-group" data-toggle="btn-toggle" >
        <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
    </div>
    </div>
</div>
<div class="box-body chat" id="chat-box">
    <!-- chat item -->
    <div class="item">
    <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">
    <p class="message">
        <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
        Mike Doe
        </a>
        I would like to meet you to discuss the latest news about
        the arrival of the new theme. They say it is going to be one the
        best themes on the market
    </p>
    <div class="attachment">
        <h4>Attachments:</h4>
        <p class="filename">
        Theme-thumbnail-image.jpg
        </p>
        <div class="pull-right">
        <button class="btn btn-primary btn-sm btn-flat">Open</button>
        </div>
    </div><!-- /.attachment -->
    </div><!-- /.item -->
    <!-- chat item -->
    <div class="item">
    <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">
    <p class="message">
        <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
        Alexander Pierce
        </a>
        I would like to meet you to discuss the latest news about
        the arrival of the new theme. They say it is going to be one the
        best themes on the market
    </p>
    </div><!-- /.item -->
    <!-- chat item -->
    <div class="item">
    <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">
    <p class="message">
        <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
        Susan Doe
        </a>
        I would like to meet you to discuss the latest news about
        the arrival of the new theme. They say it is going to be one the
        best themes on the market
    </p>
    </div><!-- /.item -->
</div><!-- /.chat -->
<div class="box-footer">
    <div class="input-group">
    <input class="form-control" placeholder="Type message...">
    <div class="input-group-btn">
        <button class="btn btn-success"><i class="fa fa-plus"></i></button>
    </div>
    </div>
</div>
</div><!-- /.box (chat box) -->
<!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>AdminLTE2/plugins/fastclick/fastclick.min.js"></script>
  </body>
</html>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
	  <form class="form-horizontal" id="form" role="form" action="#">
		<div class="modal-body">
			<style type="text/css">
			#error{color:red;}
			</style>
			<!--dirty-->
			<div id="error"></div>
			<!--dirty-->
			<div class="form-group">
				<label>原密码</label>
				<input name="原密码" type="password" class="form-control" placeholder="原密码">
			</div>
			<div class="form-group">
				<label>新密码</label>
				<input name="新密码" type="password" class="form-control" placeholder="新密码">
			</div>
			<div class="form-group">
				<label>确认密码</label>
				<input name="确认密码" type="password" class="form-control" placeholder="确认密码">
			</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			<button id="btnSave" type="submit" class="btn btn-primary" onclick="save()">保存</button>
		</div>
	  </form>
    </div>
  </div>
</div>



