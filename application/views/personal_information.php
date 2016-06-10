<!-- iCheck for radio inputs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>AdminLTE2/plugins/iCheck/all.css">

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
	  <form id="form" role="form" action="#">
		<div class="modal-body">
			<style type="text/css">#error{color:red;}</style>
			<div id="error"></div>
			<div class="form-group">
				<label>原密码</label>
				<input name="old_password" type="password" class="form-control" placeholder="原密码">
			</div>
			<div class="form-group">
				<label>新密码</label>
				<input name="new_password" type="password" class="form-control" placeholder="新密码">
			</div>
			<div class="form-group">
				<label>确认密码</label>
				<input name="confirm_password" type="password" class="form-control" placeholder="确认密码">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			<button id="btnSave" type="submit" class="btn btn-primary" onclick="save()">保存</button>
		</div>
	  </form>
    </div>
  </div>
</div>

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<button class="btn btn-danger" onclick="change_password()"><i class="glyphicon glyphicon-lock"></i>修改密码</button>
	</div>
	<div class="box-body">				
		<section>		
			<div class="panel">
				<div class="panel-heading"></div>
				<div class="panel-body">
					<form id="personalInfo" class="form-horizontal" role="form" action="#">						
						<div class="form-group">
							<label class="col-lg-4 control-label">学号：</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" name="student_number" id="student_number" value="<?php echo $userdata->student_number; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label">姓名：</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" name="name" id="name" placeholder="姓名" value="<?php echo $userdata->name; ?>" readonly />
							</div>
							<div class="col-lg-3" id="error"></div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label">性别：</label>
							<div class="col-lg-3">
								<div class="radio icheck" id="sex" name="sex">
									<label>
										<input type="radio" name="sex" value="男" id="male" class="minimal" disabled> 男  
									</label>
									<label>
										<input type="radio" name="sex" value="女" id="female" class="minimal" disabled> 女 
									</label>
								</div>	
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label">权限：</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" name="permission_id" value="<?php echo $userdata->permission_id==1?"管理员":"普通用户"; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label">年级：</label>
							<div class="col-lg-3">
								<select name="grade" id="grade" class="form-control" style="display: none">
									<option value="">--选择年级--</option>
									<?php foreach($grade as $select): ?>
									<option value="<?php echo $select->grade; ?>"><?php echo $select->grade; ?></option>
									<?php endforeach;?>
								</select>
								<input type="text" class="form-control" id="gradeText" value="<?php echo $userdata->grade; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label">专业：</label>
							<div class="col-lg-3">
								<select name="major" id="major" class="form-control" style="display: none">
									<option value="">--选择专业--</option>
									<?php foreach($major as $select): ?>
									<option value="<?php echo $select->major; ?>"><?php echo $select->major; ?></option>
									<?php endforeach;?>
								</select>
								<input type="text" class="form-control" id="majorText" value="<?php echo $userdata->major; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label">余额：</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" name="account_balance" id="account_balance" value="￥ <?php echo $userdata->account_balance; ?>" readonly />
							</div>
						</div>
						<br />
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-5">
								<button type="button" class="btn btn-info" id="btnEdit"><i class="glyphicon glyphicon-pencil"></i>修改个人信息</button>
								<button type="button" class="btn btn-default" id="btnCancel" style="display: none">取消修改</button>
								<button type="submit" class="btn btn-primary" id="btnSave" name="confirm" style="display: none" onclick="save()">确认修改</button>
							</div>
							<!--onclick里面的函数名不能和按钮Id名一样，否则会被覆盖掉-->
						</div>					
					</form>
				</div>
			</div>
		</section>
	</div>
</div>

<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/iCheck/icheck.min.js"></script>
<script>
var save_method;
$(function() 
{
	$('input:radio[name="sex"][value="<?php echo $userdata->sex; ?>"]').prop('checked',true);
	$('input[type="radio"].minimal').iCheck({radioClass: 'iradio_minimal-blue'});
	$("#btnEdit").click(
		function()
		{
			$("#name").removeAttr("readonly");
			$("#male").removeAttr("disabled");
			$("#female").removeAttr("disabled");
			$('input[type="radio"].minimal').iCheck({radioClass: 'iradio_minimal-blue'});
			$("#grade").show();
			$("#gradeText").hide();
			$("#grade").val("<?php echo $userdata->grade; ?>");
			$("#major").show();
			$("#majorText").hide();
			$("#major").val("<?php echo $userdata->major; ?>");	
			$("#btnEdit").hide();
			$("#btnCancel").show();
			$('[name="confirm"]').show();
		});
	$("#btnCancel").click(
		function()
		{
			$("#sexRadio").hide();
			$("#sexText").show();
			$("#gradeText").show();
			$("#grade").hide();
			$("#majorText").show();
			$("#major").hide();
			$("#name").val("<?php echo $userdata->name; ?>");
			$('input:radio[name="sex"][value="<?php echo $userdata->sex; ?>"]').prop('checked',true);
			$('input:radio[name="sex"]').attr("disabled",true);
			$('input').attr("readonly",true);
			$("#btnEdit").show();
			$("#btnCancel").hide();
			$('[name="confirm"]').hide();
		});
});
function change_password()
{
	save_method='pswd';
	$("#error").html(''); // reset error on modals
	$('#form')[0].reset(); // reset form on modals
	$('input').attr("readonly",false);
	$("#btnSave").show();
	$('#modal_form').modal('show'); // show bootstrap modal
	$('.modal-title').text('修改密码'); // Set Title to Bootstrap modal title
}
function save() 
{
	$('#btnSave').text('保存中'); //change button text
	$('#btnSave').attr('disabled',true); //set button disable
	if(save_method=='pswd')
	{
		data=$('#form').serialize();
		url="<?php echo site_url('user/change_password') ?>";
	}	
	else
	{
		data=$('#personalInfo').serialize();
		url="<?php echo site_url('user/update_personal_info') ?>";
	}		
	$.ajax({
        url:url,
        type:"POST",
        data:data,
        dataType:"JSON",
        success:function(data)
        {
            if(data.status) //if success close modal and reload ajax table
				location.reload();
            else
				if(save_method=='pswd')
					$("#error").html(data.error);
				else
					alert(data.error);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
 
        },
        error:function(jqXHR,textStatus,errorThrown)
        {
            alert('修改发生错误！');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}
</script>