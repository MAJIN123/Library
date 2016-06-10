<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/iCheck/square/blue.css">
    <!--<div class="alert alert-warning">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>提醒！</strong><div id="reminding"></div>
    </div>-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-box-body">
        <form action="#" id="form">
          <p class="text-red" id="error"></p>
          <div class="form-group has-feedback">
            <input name="ISBN" class="form-control" placeholder="ISBN">
            <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="book_name" class="form-control" placeholder="书名">
            <span class="glyphicon glyphicon-book form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="student_number" class="form-control" placeholder="学号">
            <span class="glyphicon glyphicon-piggy-bank form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="name" class="form-control" placeholder="姓名">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
              <button id="btnSave" type="submit" class="btn btn-primary btn-block btn-flat" onclick="return_book()">归还</button>
            </div><!-- /.col -->
          </div>
        </form>    
           
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
  </body>

</html>
<script>
$(function() 
{
    $('input').iCheck({
    checkboxClass:'icheckbox_square-blue',
    radioClass:'iradio_square-blue',
    increaseArea:'20%' // optional
    });
});
function return_book()
{
  $('#btnSave').text('提交中'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable
  data=$('#form').serialize();
  url="<?php echo site_url('return_book/ajax_return_book')?>";
  $.ajax({
        url:url,
        type:"POST",
        data:data,
        dataType:"JSON",
        success:function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                location.reload();
                alert(data.reminding);
                // $("#myAlert").attr('class','alert alert-warning');
                // $("#myAlert").show();
                // $("#reminding").html(data.reminding);
            }
            else
                $("#error").html(data.error);
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        },
        error:function(jqXHR,textStatus,errorThrown)
        {
            alert('Error adding / editting data');
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}
</script>
