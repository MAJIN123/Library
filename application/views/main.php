<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library Management</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>AdminLTE2/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="<?php echo base_url();?>AdminLTE2/bootstrap/offline/ionicons-2.0.1/js/ionic.bundle.min.js"></script>-->
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>AdminLTE2/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>AdminLTE2/dist/js/demo.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url();?>index.php/menu" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>LM</b>S</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="font-size:25px;font-family:kaiTi"><b>图书馆管理系统</b></span>
        </a>
        <?php 
        if($this->session->userdata('sex')=='男')
            $img='AdminLTE2/dist/img/user2-160x160.jpg';
        else if($this->session->userdata('sex')=='女')
            $img='AdminLTE2/dist/img/user4-128x128.jpg'
        ?>
        <!-- Header Navbar-->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">    
                  <img src="<?php echo base_url()."".$img;?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('name') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url()."".$img;?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $this->session->userdata('name') ?>
                      <small><?php date_default_timezone_set('PRC');echo date("Y年m月d日 H:i:s") ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--<div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a href="<?php echo site_url('login/login_out') ?>" class="btn btn-default btn-flat">登出</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url()."".$img;?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('name') ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">菜单</li>
            <li><a href="<?php echo site_url('menu/home_page') ?>"><i class="glyphicon glyphicon-home"></i> <span>首页</span></a></li>
            <li class="treeview">
              <a href="<?php echo site_url('menu') ?>">
                <i class="glyphicon glyphicon-book"></i>
                <span>借书</span>
                <!--<span class="label label-primary pull-right">4</span>-->
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo site_url('menu') ?>">
                <i class="glyphicon glyphicon-bookmark"></i> <span>还书</span> 
                <!--<small class="label pull-right bg-green">Hot</small>-->
              </a>
            </li>
            <?php if($this->session->userdata('permissionId')==1): ?>
            <li class="treeview">
              <a href="<?php echo site_url('menu/book_management') ?>">
                <i class="glyphicon glyphicon-tasks"></i>
                <span>图书管理</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo site_url('menu') ?>">
                <i class="fa fa-edit"></i> <span>用户管理</span>
                <!--<i class="fa fa-angle-left pull-right"></i>-->
              </a>
            </li>
            <?php endif ?>
            <li class="treeview">
              <a href="<?php echo site_url('menu') ?>">
                <i class="glyphicon glyphicon-list"></i> <span>借书记录</span>
                <!--<i class="fa fa-angle-left pull-right"></i>-->
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('menu') ?>">
                <i class="glyphicon glyphicon-remove-sign"></i> <span>罚款规则</span>
                <!--<small class="label pull-right bg-red">3</small>-->
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('menu') ?>">
                <i class="glyphicon glyphicon-comment"></i> <span>读者评论</span>
                <!--<small class="label pull-right bg-yellow">12</small>-->
              </a>
            </li>
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title ?>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <?php $this->load->view($url);?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://scst.suda.edu.cn">计算机科学与技术学院</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    
  </body>
</html>
