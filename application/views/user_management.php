<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
<!--remove 'fade' class and animation will disappear-->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
				<label>学号</label>
				<input name="student_number" type="text" class="form-control" placeholder="学号">
			</div>
			<div class="form-group">
				<label>姓名</label>
				<input name="name" type="text" class="form-control" placeholder="姓名">
			</div>
			<div class="form-group">
				<label>权限</label>
				<select name="permission_id" id="permission_id" class="form-control">
					<option value="">--选择权限--</option>
					<?php foreach($permission as $select): ?>
					<option value="<?php echo $select->permission_id; ?>"><?php echo $select->permission; ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label>性别</label>
				<div class="radio icheck" id="sex" name="sex">
					<label>
						<input type="radio" name="sex" value="男" id="male" class="minimal"> 男  
					</label>
					<label>
						<input type="radio" name="sex" value="女" id="female" class="minimal"> 女 
					</label>	
				</div>	
				<input type="text" class="form-control" name="sex" id="sexText" style="display: none" readonly>
			</div>
			<div class="form-group">
				<label>年级</label>
				<select name="grade" id="grade" class="form-control">
					<option value="">--选择年级--</option>
					<?php foreach($grade as $select): ?>
					<option value="<?php echo $select->grade; ?>"><?php echo $select->grade; ?></option>
					<?php endforeach;?>
				</select>
			</div>
            <div class="form-group">
				<label>专业</label>
				<select name="major" id="major" class="form-control">
					<option value="">--选择专业--</option>
					<?php foreach($major as $select): ?>
					<option value="<?php echo $select->major; ?>"><?php echo $select->major; ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label>余额</label>
				<input name="account_balance" type="text" class="form-control" placeholder="余额">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
			<button id="btnSave" type="submit" class="btn btn-primary" onclick="save()">保存</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<!--添加信息的modal-->

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<button class="btn btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i>添加用户</button>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="user_management" class="table table-bordered table-striped">
		<thead>
			<tr>   
			<th>学号</th>    
			<th>姓名</th>
            <th>权限</th>
			<th>操作</th>
			<th>更多</th>
			</tr>
		</thead>
		<!--<tfoot>
			<tr>   
			<th>学号</th>    
			<th>姓名</th>
            <th>性别</th>
			<th>操作</th>
			<th>更多</th>
			</tr>
		</tfoot>-->
		</table>
	</div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/bootstrap-spinner/jquery.spinner.min.js"></script>
<script>	
var save_method;
var table;
$('#user_management').DataTable
({
	processing:true,
	serverSide:true,
	order:[],
	ajax:
	{
		url:"<?php echo site_url('user/ajax_user_list')?>",
		type:'POST'
	},
	columnDefs: 
	[
        {
            "targets":[-1], //last column
            "orderable":false, //set not orderable
        },
    ],
});
$('input[type="radio"].minimal').iCheck({radioClass: 'iradio_minimal-blue'});
function add_user()
{
	save_method='add';
	$("#error").html(''); // reset error on modals
	$('#form')[0].reset(); // reset form on modals
	$('input').attr("readonly",false);
	$("#male").removeAttr("disabled");
	$("#female").removeAttr("disabled");
	$('#sexText').hide();
	$('#sex').show();
	$('input[type="radio"].minimal').iCheck({radioClass:'iradio_minimal-blue'});
	$("#grade").removeAttr("disabled");
	$("#major").removeAttr("disabled");
	$("#permission_id").removeAttr("disabled");
	$("#btnSave").show();
	$('#modal_form').modal('show'); // show bootstrap modal
	$('.modal-title').text('添加用户'); // Set Title to Bootstrap modal title
}
function edit_user(student_number)
{
	save_method='update';
	$("#error").html(''); // reset form on modals
	$('#form')[0].reset();
	$.ajax({
		url : "<?php echo site_url('user/ajax_detailed_info/')?>/"+student_number,
		type: "GET",
		dataType: "JSON",
		success:function(data)
		{
			$('[name="student_number"]').val(data.student_number);
			$('[name="student_number"]').attr("readonly",true);
			$('[name="name"]').val(data.name);
			$('[name="name"]').attr("readonly",true);
			$('#sexText').show();
			$('#sexText').val(data.sex);
			$('#sexText').attr("readonly",true);
			$('#sex').hide();
			// alert(data.sex);
			// $("input:radio[name='sex'][value='"+data.sex +"']").prop('checked',true);
			$('[name="grade"]').val(data.grade);
			$('[name="major"]').val(data.major);
			$('[name="permission_id"]').val(data.permission_id);
			$('[name="permission_id"]').attr("disabled",true);
			$('[name="account_balance"]').val(data.account_balance);
			$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('修改信息'); // Set title to Bootstrap modal title
		},
		error:function(jqXHR,textStatus,errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}
function delete_user(student_number)
{
    if(confirm('确认删除该用户信息？'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('user/ajax_delete_user')?>/"+student_number,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
				location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}
function save() 
{
	$('#btnSave').text('保存中'); //change button text
	$('#btnSave').attr('disabled',true); //set button disable
	data=$('#form').serialize();
	if(save_method=='add') 
		url="<?php echo base_url();?>index.php/user/ajax_add_user";//call function ajax_add_role if add 
	else if(save_method=='update')
		url="<?php echo base_url();?>index.php/user/update_personal_info";
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
            }
            else
			{
				$("#error").html(data.error);
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
 
        },
        error:function(jqXHR,textStatus,errorThrown)
        {
            alert('Error adding / editting data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}
</script>