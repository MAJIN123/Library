<!--<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/bootstrap-spinner/bootstrap-spinner.css">-->
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
				<label>ISBN</label>
				<input name="ISBN" type="text" class="form-control" placeholder="ISBN">
			</div>
			<div class="form-group">
				<label>书名</label>
				<input name="book_name" type="text" class="form-control" placeholder="书名">
			</div>
			<div class="form-group">
				<label>作者</label>
				<input name="author" type="text" class="form-control" placeholder="作者">
			</div>
			<div class="form-group">
				<label>出版社</label>
				<input name="press" type="text" class="form-control" placeholder="出版社">
			</div>
			<div class="form-group">
				<label>类别</label>
				<select name="category" class="form-control">
					<option value="">--选择类别--</option>
					<?php foreach($book as $select):?>
					<option value="<?php echo $select->category?>"><?php echo $select->category?></option>
					<?php endforeach;?>
				</select>
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
				<label>ISBN</label>
				<input name="ISBN" type="text" class="form-control" placeholder="ISBN">
			</div>
			<div class="form-group">
				<label>书名</label>
				<input name="book_name" type="text" class="form-control" placeholder="书名">
			</div>
			<div class="form-group">
				<label>藏量 </label>
				<span class="tb-stock" id="J_Stock">
				<input name="collections" type="text" style="width:70px;height:34px;text-align:center" class="tb-text" maxlength="8" placeholder="藏量"> 件
				</span>
				<!--<div class="input-group spinner" data-trigger="spinner" id="spinner">
					<input type="text" class="form-control" value="1" data-max="10" data-min="1" data-step="1">
					<div class="input-group-addon">
						<a href="javascript:;" class="spin-up" data-spin="up"><i class="icon-sort-up"></i></a>
						<a href="javascript:;" class="spin-down" data-spin="down"><i class="icon-sort-down"></i></a>
					</div>
				</div>-->
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

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i>添加图书</button>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="book_management" class="table table-bordered table-striped">
		<thead>
			<tr>   
			<th>书名</th>    
			<th>作者</th>
            <th>馆藏量</th>
            <th>剩余量</th>
			<th>操作</th>
			<th>更多</th>
			</tr>
		</thead>
		<tfoot>
			<tr>   
			<th>书名</th>    
			<th>作者</th>
            <th>馆藏量</th>
            <th>剩余量</th>
			<th>操作</th>
			<th>更多</th>
			</tr>
		</tfoot>
		</table>
	</div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>	
var save_method;
$('#book_management').DataTable
({
	processing:true,
	serverSide:true,
	order:[],
	ajax:
	{
		url:"<?php echo site_url('book/ajax_book_list')?>",
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
function add_book()
{
	save_method='add';
	$("#error").html(''); // reset error on modals
	$('#form')[0].reset(); // reset form on modals
	$('input').attr("readonly",false);
	$('select').attr("disabled",false);
	$("#btnSave").show();
	$('#modal_form').modal('show'); // show bootstrap modal
	$('.modal-title').text('添加图书'); // Set Title to Bootstrap modal title
}
function detailed_info(ISBN)
{
	$("#btnSave").hide();
	$("#error").html(''); // reset form on modals
	$('#form')[0].reset();
	$.ajax({
	url:"<?php echo site_url('book/ajax_detailed_info/')?>/"+ISBN,
	type:"GET",
	dataType:"JSON",
	success:function(data)
	{
		$('[name="ISBN"]').val(data.ISBN);
		$('[name="ISBN"]').attr("readonly",true);
		$('[name="book_name"]').val(data.book_name);
		$('[name="book_name"]').attr("readonly",true);
		$('[name="author"]').val(data.author);
		$('[name="author"]').attr("readonly",true);
		$('[name="press"]').val(data.press);
		$('[name="press"]').attr("readonly",true);
		$('[name="category"]').val(data.category);
		$('[name="category"]').attr("disabled",true);
		$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
		$('.modal-title').text('详细信息'); // Set title to Bootstrap modal title
	},
	error:function(jqXHR,textStatus,errorThrown)
	{
		alert('Error get data from ajax');
	}
	});
}
function edit_book(ISBN)
{
	save_method='update';
	$("#error").html(''); // reset form on modals
	$('#form')[0].reset();
	$.ajax({
	url : "<?php echo site_url('book/ajax_detailed_info/')?>/"+ISBN,
	type: "GET",
	dataType: "JSON",
	success:function(data)
	{
		var diff=data.collections-data.remaining_number;
		$('[name="ISBN"]').val(data.ISBN);
		$('[name="ISBN"]').attr("readonly",true);
		$('[name="book_name"]').val(data.book_name);
		$('[name="book_name"]').attr("readonly",true);
		$('[name="collections"]').val(data.collections);	
		$('[name="collections"]').keypress(
			function(key) 
			{
				var keyCode=key.keyCode?key.keyCode:key.charCode;
				if(keyCode!=0&&(keyCode<48||keyCode>57)&&keyCode!=8&&keyCode!=37&&keyCode!=39)
					return false;
				else
					return true;
			}).blur(
				function() 
				{
					var numVal=parseInt($('[name="collection"]').val())||0;
					numVal=numVal<diff?data.collections:numVal;
					$('[name="collection"]').val(numVal);
				});
		// .keyup(
		// function(e) 
		// {
		// 	var keyCode=e.keyCode?e.keyCode:e.charCode;
		// 	console.log(keyCode);
		// 	if(keyCode!=8)
		// 	{
		// 		var numVal=parseInt($('[name="collection"]').val())||0;
		// 		numVal=numVal<diff?data.collections:numVal;
		// 		$('[name="collection"]').val(numVal);
		// 	}
		// })
		// (function ($) {
		// 	$('#sub').on('click', function() {
		// 		$('#bookNum').val( parseInt($('#bookNum').val(), 10) - 1);
		// 	});
		// 	$('#add').on('click', function() {
		// 		$('#bookNum').val( parseInt($('#bookNum').val(), 10) + 1);
		// 	});
		// })(jQuery);
		$('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
		$('.modal-title').text('修改信息'); // Set title to Bootstrap modal title
	},
	error:function(jqXHR,textStatus,errorThrown)
	{
		alert('Error get data from ajax');
	}
	});
}
function delete_book(ISBN)
{
    if(confirm('确认删除本书全部信息？'))
    {
        // ajax delete data to database
        $.ajax({
            url:"<?php echo site_url('book/ajax_delete_book')?>/"+ISBN,
            type:"POST",
            dataType:"JSON",
            success:function(data)
            {
				location.reload();
            },
            error:function (jqXHR, textStatus, errorThrown)
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
		url="<?php echo base_url();?>index.php/book/ajax_add_book";//call function ajax_add_book if add 
	}
	else if(save_method=='update')
	{
		data=$('#edit').serialize()
		url="<?php echo base_url();?>index.php/book/ajax_update_book";
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