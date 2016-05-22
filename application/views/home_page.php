<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 简单的轮播（Carousel）插件</title>
   <link href="<?php echo base_url();?>AdminLTE2/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="<?php echo base_url();?>AdminLTE2/scripts/jquery/2.0.0/jquery.min.js"></script>
   <script src="<?php echo base_url();?>AdminLTE2/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<div id="myCarousel" class="carousel slide">
   <!-- 轮播（Carousel）指标 -->
   <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
   </ol>   
   <!-- 轮播（Carousel）项目 -->
   <div class="carousel-inner">
      <div class="item active">
         <img src="<?php echo base_url();?>AdminLTE2/dist/img/556429.png ?>" alt="First slide">
      </div>
      <div class="item">
         <img src="<?php echo base_url();?>AdminLTE2/dist/img/1082113.png" alt="Second slide">
      </div>
      <div class="item">
         <img src="<?php echo base_url();?>AdminLTE2/dist/img/1082114.png" alt="Third slide">
      </div>
      <div class="item">
         <img src="<?php echo base_url();?>AdminLTE2/dist/img/1082117.png" alt="Fourth slide">
      </div>
   </div>
   <!-- 轮播（Carousel）导航 -->
   <a class="carousel-control left" href="#myCarousel" 
      data-slide="prev">&lsaquo;</a>
   <a class="carousel-control right" href="#myCarousel" 
      data-slide="next">&rsaquo;</a>
</div> 

</body>
</html>