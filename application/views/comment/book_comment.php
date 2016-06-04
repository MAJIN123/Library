<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE2/plugins/iCheck/all.css">
<div class="modal fade" id="modal_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<!--modal-sm and modal-lg	-->
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
	  <form id="form" role="form" action="#">
		<div class="modal-body">
			<style type="text/css">
			#error{color:#dd4b39;}
			</style>
			<!--dirty-->
			<div id="error"></div>
			<!--dirty-->
      <div class="form-group">
				<label>ISBN</label>
				<input name="ISBN" type="text" class="form-control" placeholder="ISBN">
			</div>
			<div class='form-group'>
        <input name="comment" type="text" class="form-control" placeholder="我的评论">                                      
      </div> 
      <div class="row">
        <div class="col-sm-8">
          <div class="checkbox icheck">
            <label>
              <input name="is_anonymous" type="checkbox" class="flat-red"> 匿名
            </label>
          </div>
        </div><!-- /.col -->
      </div> 
		</div>
		<div class="modal-footer">
			<button id="btnSave" type="submit" class="btn btn-primary" onclick="save()">保存</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
		</div>
	  </form>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <p class="lead text-center">书籍信息</p>
          <?php if($book->image!=null): ?>
          <img class="profile-user-img img-responsive" src="<?php echo base_url()."".$book->image; ?>" alt="User profile picture">
          <?php endif; ?>
          <?php if($book->image==null)echo '<p class="text-center">暂无图片</p>'; ?>
          <p class="text-muted text-center"><?php echo $book->ISBN ?></p>
          
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>书名：</b> <a class="pull-right"><?php echo $book->book_name ?></a>
            </li>
            <li class="list-group-item">
              <b>作者：</b> <a class="pull-right"><?php echo $book->author ?></a>
            </li>
            <li class="list-group-item">
              <b>出版社：</b> <a class="pull-right"><?php echo $book->press ?></a>
            </li>
            <li class="list-group-item">
              <b>藏书量：</b> <a class="pull-right"><?php echo $book->collections ?></a>
            </li>
            <li class="list-group-item">
              <b>剩余量：</b> <a class="pull-right"><?php echo $book->remaining_number ?></a>
            </li>
          </ul>
          <a href="#demo" class="btn btn-info btn-block" data-toggle="collapse" data-target="#demo"><b>我的评论</b></a>
          <div id="demo" class="collapse">
            <div>
              <?php 
              if($my_comment==null)
              {
                  echo '评论暂无</br>';
                  echo '<button class="btn btn-success" onclick="add_comment()"><i class="glyphicon glyphicon-plus"></i>添加评论</button>';
              }
              else
              {
                  echo $my_comment->comment;
                  echo '</br>';
                  echo '<a class="btn btn-sm btn-warning" href="javascript:void()" title="修改评论" onclick="edit_comment()"><i class="glyphicon glyphicon-pencil"></i>修改评论</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="删除评论" onclick="delete_comment()"><i class="glyphicon glyphicon-trash"></i>删除评论</a>';
              }
              ?>
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div class="col-md-9">
      <!-- comment box -->
      <!--<div class="box box-success">
        <div class="box-header">
          <i class="fa fa-comments-o"></i>
          <h3 class="box-title">评论列表</h3>
        </div>
        <div class="box-body chat" id="chat-box">-->
          <!-- comment item -->
          <!--<div class="item">
            <img src="<?php echo base_url();?>AdminLTE2/dist/img/user4-128x128.jpg" alt="user image" class="online">
            <p class="message">
              <a href="#" class="name">
                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                Mike Doe
              </a>
              I would like to meet you to discuss the latest news about
              the arrival of the new theme. They say it is going to be one the
              best themes on the market
            </p>-->
          <!--</div> /.item -->
          
          <!-- comment item -->
          <!--<div class="item">
            <img src="<?php echo base_url();?>AdminLTE2/dist/img/user3-128x128.jpg" alt="user image" class="offline">
            <p class="message">
              <a href="#" class="name">
                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                Alexander Pierce
              </a>
              I would like to meet you to discuss the latest news about
              the arrival of the new theme. They say it is going to be one the
              best themes on the market
            </p>
          </div> /.item -->
          <!-- comment item -->
          <!--<div class="item">
            <img src="<?php echo base_url();?>AdminLTE2/dist/img/user2-160x160.jpg" alt="user image" class="offline">
            <p class="message">
              <a href="#" class="name">
                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                Susan Doe
              </a>
              I would like to meet you to discuss the latest news about
              the arrival of the new theme. They say it is going to be one the
              best themes on the market
            </p>
          </div> /.item -->
          <!-- comment item -->
          <!--<div class="item">
            <img src="<?php echo base_url();?>AdminLTE2/dist/img/user2-160x160.jpg" alt="user image" class="offline">
            <p class="message">
              <a href="#" class="name">
                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                Susan Doe
              </a>
              I would like to meet you to discuss the latest news about
              the arrival of the new theme. They say it is going to be one the
              best themes on the market
            </p>
          </div> /.item -->
          <!-- chat item -->
          <!--<div class="item">
            <img src="<?php echo base_url();?>AdminLTE2/dist/img/user2-160x160.jpg" alt="user image" class="offline">
            <p class="message">
              <a href="#" class="name">
                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                Susan Doe
              </a>
              I would like to meet you to discuss the latest news about
              the arrival of the new theme. They say it is going to be one the
              best themes on the market
            </p>
          </div> /.item -->
        <!--</div> /.comment -->
        <!--<div class="box-footer">
          <form id="form" class='form-horizontal'>
            <div class='form-group margin-bottom-none'>
              <div class='col-sm-12'>
                <input name="comment" class="form-control input-sm" placeholder="我的评论">
              </div>                                                
            </div> 
            <div class="row">
              <p></p>
              <div class="col-sm-8">
                <div class="checkbox icheck">
                  <label>
                    <input name="is_anonymous" type="checkbox" class="flat-red"> 匿名
                  </label>
                </div>
              </div> /.col -->
              <!--<div class="col-sm-4">
                <button type="submit" class="btn btn-danger btn-block btn-flat" onclick="save()">保存</button>
              </div> /.col   -->
            <!--</div>                   
          </form>
        </div>
      </div> /.box (comment box) -->
      <!-- Box Comment -->
      <?php $count=0;foreach($comment as $info): ?>
        <div class="box box-widget">
          <div class='box-header with-border'>
            <div class='user-block'>
              <img class='img-circle' src='<?php echo base_url()."".$info->image; ?>' alt='user image'>
              <span class='username'>
                <a href="#">
                <?php if($info->is_anonymous)echo $info->name;else echo '匿名用户'; ?>
                </a>
                </span>
              <span class='description'>公开发表 - <?php echo $info->comment_time; ?></span>
            </div><!-- /.user-block -->
            <div class='box-tools'>
              <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
              <button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class='box-body'>
            <!-- post text -->
            <p><?php echo $info->comment; ?></p>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
        <?php $count++;if($count==5)break; ?>
      <?php endforeach; ?>
    </div><!-- /.col -->
  </div><!-- /.row -->

<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/iCheck/icheck.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script>	
var save_method;
$(function() 
{
    $('input[type="checkbox"].flat-red').iCheck
    ({
        checkboxClass:'icheckbox_flat-red',
    });
});
function add_comment()
{
    save_method='add';
    $("#error").html(''); // reset error on modals
    $('#form')[0].reset(); // reset form on modals
    $('input').attr("readonly",false);
    $('[name="ISBN"]').val('<?php echo $book->ISBN ?>');
    $('[name="ISBN"]').attr("readonly",true);
    $("#btnSave").show();
    $('#modal_comment').modal('show'); // show bootstrap modal
    $('.modal-title').text('<?php echo $book->book_name ?>'); // Set Title to Bootstrap modal title
}
function edit_comment()
{
}
function delete_comment()
{
}
function save() 
{
    $('#btnSave').text('保存中'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    if(save_method=='add') 
      url="<?php echo site_url('comment/ajax_add_comment/')?>/"+'<?php echo $book->ISBN ?>';//call function ajax_add_book if add 
    $.ajax
    ({
        url:url,
        type:"POST",
        data:$('#form').serialize(),
        dataType:"JSON",
        success:function(data)
        {
            if(data.status) //if success close modal and reload ajax table
                location.reload();
            else
                $("#error").html(data.error);
                $('#btnSave').text('保存'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable
        },
        error:function(jqXHR,textStatus,errorThrown)
        {
            alert('Error adding comment');
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}
</script>


