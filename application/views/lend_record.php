<!--<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/bootstrap-spinner/bootstrap-spinner.css">-->
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/bootstrap-table-develop/dist/bootstrap-table.css" >
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datepicker/datepicker3.css" >
<div class="box">
	<div class="box-body">
        <a id="toolbar" href="<?php echo site_url('menu/personal_information'); ?>" class="btn btn-danger"><i class="glyphicon glyphicon-user"></i>个人信息</a>
        <table id="lend_record" class="table table-bordered"></table>
	</div>
</div>

<script src="<?php echo base_url();?>AdminLTE2/plugins/bootstrapValidator/bootstrapValidator.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js" ></script>
<script src="<?php echo base_url();?>AdminLTE2/bootstrap-table-develop/dist/bootstrap-table.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/bootstrap-table-develop/dist/bootstrap-table-zh-CN.min.js"></script>

<script>
$(document).ready(function() 
{
    $("#lend_record").bootstrapTable({
		url:"<?php echo site_url('lend_book/lend_record_list')?>",
		dataType:"json",
		pagination:true,	
        toolbar:"#toolbar",//自定义工具栏
		search:true,//搜索框
		showPaginationSwitch:true,//分页切换工具
		showRefresh:true,//刷新工具
		showToggle:true,//切换工具
		showColumns:true,//列过滤器工具
		pageSize:10,//初始每页显示条数
		pageList:[10,25,50,100],//可选每页显示条数
		paginationPreText:"上一页",
		paginationNextText:"下一页",
		columns:[
        {
			title:"书名",
			field:"book_name",
			align:"center",
			valign:"middle",
			sortable:true
		},
		{
			title:"ISBN",
			field:"ISBN",
			align:"center",
			valign:"middle",
			sortable:true
		},
        {
			title:"用户名",
			field:"name",
			align:"center",
			valign:"middle",
			sortable:true
		},
		{
			title:"学号",
			field:"student_number",
			align:"center",
			valign:"middle",
			sortable:true
		},
		{
			title:"借阅时间",
			field:"lend_time",
			align:"center",
			valign:"middle",
			sortable:true
		},
		{
			title: "归还时间",
			field: "return_time",
			align: "center",
			valign: "middle",
			sortable: true
		}
        ]
    });	   
});
</script>