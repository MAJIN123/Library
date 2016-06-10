<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head></head>
=======
<head>
    <link href="<?php echo base_url();?>AdminLTE2/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>AdminLTE2/scripts/jquery/2.0.0/jquery.min.js"></script>
    <script src="<?php echo base_url();?>AdminLTE2/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
>>>>>>> d95913ace9946f2f853e236ae6dc687893ad21f2
<body>

<!--<div id="myCarousel" class="carousel slide" style="width:256px;">-->
   <!-- 轮播（Carousel）指标 -->
   <!--<ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
   </ol>   -->
   <!-- 轮播（Carousel）项目 -->
   <!--<div class="carousel-inner">
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
   </div>-->
   <!-- 轮播（Carousel）导航 -->
   <!--<a class="carousel-control left" href="#myCarousel" 
      data-slide="prev">&lsaquo;</a>
   <a class="carousel-control right" href="#myCarousel" 
      data-slide="next">&rsaquo;</a>
</div>-->

<!-- row -->
<div class="row">
<div class="col-md-12">
    <!-- The time line -->
    <ul class="timeline">
        <?php $temp=null; ?>
        <?php foreach($operation as $operation): ?>
            <!-- timeline time label -->
            <li class="time-label">
            <?php $timestamp=strtotime($operation->operation_time);$date=intval(date('Ymd',$timestamp)); ?>
            <?php if($temp!=$date): ?>
                <?php 
                    if($date%3==0)   
                        echo '<span class="bg-navy">';
                    if($date%3==1)   
                        echo '<span class="bg-red">'; 
                    if($date%3==2) 
                        echo '<span class="bg-green">'; 
                    echo date('Y年m月d日',$timestamp);
                    echo '</span>';
                    $temp=$date;
                ?>
            <?php endif; ?>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
            <?php if($operation->note=='add_book'): ?>
                <i class="fa fa-book bg-maroon"></i>
            <?php endif; ?>
            <?php if($operation->note=='lend_book'): ?>
                <i class="fa fa-reply bg-orange"></i>
            <?php endif; ?>
            <?php if($operation->note=='return_book'): ?>
                <i class="fa fa-share bg-aqua"></i>
            <?php endif; ?>
            <?php if($operation->note=='add_comment'): ?>
                <i class="fa fa-comments bg-purple"></i>
            <?php endif; ?>
            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $operation->operation_time; ?></span>
                <h3 class="timeline-header no-border"> 
                    <!--<img class='img-circle' src='<?php echo base_url()."".$operation->user_image; ?>' alt='user image'>-->
                    <?php 
                    if($operation->note=='add_book'||$operation->note=='lend_book'||$operation->note=='return_book')
                    {
                        if($operation->permission_id==1) $permission='管理员';else $permission='普通用户';
                        $display_name=$permission."".'<a href="#">'."".str_pad(substr($operation->student_number,0,2),strlen($operation->student_number),"*")."".'</a>';
                    } 
                    else if($operation->note=='add_comment')
                    {
                        $name=!$operation->is_anonymous?$operation->name:'匿名用户';
                        $display_name='<a href="#">'."".$name."".'</a>';
                    }
                    if($operation->student_number==$this->session->userdata('studentNumber'))
                        $display_name='<a href="#">我</a>';
                    ?>
                    <?php 
                    if($operation->note=='add_book')
                        $activity='添加了新书';
                    if($operation->note=='lend_book')  
                        $activity='借阅了';  
                    if($operation->note=='return_book')  
                        $activity='归还了'; 
                    if($operation->note=='add_book'||$operation->note=='lend_book'||$operation->note=='return_book')
                        $display_activity=$activity."".'<a href="#">《'."".$operation->book_name."".'》</a>';
                    if($operation->note=='add_comment')
                        $display_activity='对<a href="#">《'."".$operation->book_name."".'》</a> 发表了评论';
                    ?>
                    <?php echo $display_name; ?>
                    <?php echo $display_activity; ?>
                </h3>
                <div class="timeline-body">
                    <?php if($operation->note=='add_book'||$operation->note=='lend_book'||$operation->note=='return_book'): ?>
                        <!-- Attachment -->
                        <div class="attachment-block clearfix">                  
                            <img class="attachment-img " src="<?php echo base_url()."".$operation->book_image; ?>" alt="attachment image">
                                <div class="attachment-pushed">
                                    <h4 class="attachment-heading"></h4>
                                    <div class="attachment-text">
                                        <b>ISBN：<?php echo $operation->ISBN ?></b><br>
                                        <br>
                                        <b>书名：</b><?php echo $operation->book_name ?><br>
                                        <b>作者：</b><?php echo $operation->author ?><br>
                                        <b>出版社：</b><?php echo $operation->press ?><br>
                                    </div><!-- /.attachment-text -->
                                </div><!-- /.attachment-pushed -->
                        </div><!-- /.attachment-block -->
                    <?php endif; ?>
                    <?php if($operation->note=='add_comment'): ?>
                        <p><?php echo $operation->comment; ?></p>
                    <?php endif; ?>
                </div>
                <div class="timeline-footer">
                    <?php if($operation->note=='lend_book'||$operation->note=='return_book'): ?>
                        <a href="<?php echo site_url('menu/lend_record') ?>" class="<?php if($operation->note=='lend_book')echo 'btn btn-xs bg-orange';else echo 'btn btn-xs bg-aqua'; ?>">借书记录</a>
                    <?php endif; ?>
                    <?php if($operation->note=='add_comment'): ?>
                        <a href="<?php echo site_url('comment/book_comment') ?>/<?php echo $operation->ISBN;?>" 
                            class="btn btn-xs bg-purple">更多评论</a>
                    <?php endif; ?>
                </div>
            </div>
            </li>
            <!-- END timeline item -->
        <?php endforeach; ?>

        <li>
            <i class="fa fa-clock-o bg-gray"></i>
        </li>
    </ul>
</div><!-- /.col -->
</div><!-- /.row -->

</body>
</html>