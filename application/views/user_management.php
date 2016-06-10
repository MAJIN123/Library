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
				<input name="permission_id" type="text" class="form-control" placeholder="0-普通用户 1-管理员">
			</div>
			<div class="form-group">
				<label>年级</label>
				<input name="grade" type="text" class="form-control" placeholder="年级">
			</div>
            <div class="form-group">
				<label>学院</label>
				<input name="major" type="text" class="form-control" placeholder="学院">
			</div>
            <div class="form-group">
				<label>性别</label>
				<input name="sex" type="text" class="form-control" placeholder="性别">
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



<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<!--modal-sm and modal-lg	-->
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
	  <form id="edit" role="form" action="#">
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
			<!--<div class="form-group">
				<label>权限</label>
				<span class="tb-stock" id="J_Stock">
				<input name="permission_id" style="width:70px;height:34px;text-align:center" class="tb-text" maxlength="10"  placeholder="权限"> 0-普通用户 1-管理员
				</span>
            </div>
            -->
            
                <!--style="width:70px;height:34px;text-align:center" class="tb-text" maxlength="8"-->
				<!--<div class="input-group spinner" data-trigger="spinner" id="spinner">
					<input type="text" class="form-control" value="1" data-max="10" data-min="1" data-step="1">
					<div class="input-group-addon">
						<a href="javascript:;" class="spin-up" data-spin="up"><i class="icon-sort-up"></i></a>
						<a href="javascript:;" class="spin-down" data-spin="down"><i class="icon-sort-down"></i></a>
					</div>
				</div>-->
                
                      
            <div class="radio">
			<label>
			<input type="radio" name="permission_id" id="J_Stock2" 
				value="0">
				普通用户
            </label>
            <label>
            <input type="radio" name="permission_id" id="J_Stock1" 
                    value="1" checked> 管理员
            </label>
            </div>
            <div class="radio">
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
<!--显示的modal-->

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
function add_user()
{
	save_method='add';
	$("#error").html(''); // reset error on modals
	$('#form')[0].reset(); // reset form on modals
	$('input').attr("readonly",false);
	$("#btnSave").show();
	$('#modal_form').modal('show'); // show bootstrap modal
	$('.modal-title').text('添加用户'); // Set Title to Bootstrap modal title
}
function detailed_info(student_number)
{
	$("#btnSave").hide();
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
		$('[name="permission_id"]').val(data.permission_id);
		$('[name="permission_id"]').attr("readonly",true);
        $('[name="grade"]').val(data.grade);
		$('[name="grade"]').attr("readonly",true);	
        $('[name="major"]').val(data.major);
		$('[name="major"]').attr("readonly",true);
		$('[name="sex"]').val(data.sex);
		$('[name="sex"]').attr("readonly",true);
		$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
		$('.modal-title').text('详细信息'); // Set title to Bootstrap modal title
	},
	error:function(jqXHR,textStatus,errorThrown)
	{
		alert('Error get data from ajax');
	}
	});
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
        $("input[name='permission_id']:checked").val();
		$('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
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
	if(save_method=='add') 
	{
		data=$('#form').serialize();
		url="<?php echo base_url();?>index.php/user/ajax_add_user";//call function ajax_add_role if add 
	}
	else if(save_method=='update')
	{
		data=$('#edit').serialize()
		url="<?php echo base_url();?>index.php/user/ajax_update_user";
	}
	$.ajax({
        url:url,
        type:"POST",
        data:data,
        dataType:"JSON",
        success:function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                //$('#add_user').modal('hide');
                // reload_table();
				location.reload();
            }
            else
				$("#error").html(data.error);
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