<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
<div class="box">
    <div class="box-body">
		    <table id="comment" class="table table-hover">
		    <thead>
			  <tr>   
            <th>ISBN</th>
            <th>书名</th>
            <th>作者</th>
            <th>评论</th>
			  </tr>
		    </thead>
        <tbody>
          <?php foreach ($userdata as $row){ ?>
            <tr>
            <td><?php echo $row->ISBN ?></td>
            <td><?php echo $row->book_name ?></td>
            <td><?php echo $row->author ?></td>
            <td><a class="btn btn-sm btn-info" href="<?php echo site_url('comment/book_comment') ?>/<?php echo $row->ISBN;?>" title="评论"><i class="glyphicon glyphicon-pencil"></i>评论</a></td>
            </tr>
          <?php } ?>
        </tbody>
		    </table>
	  </div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>	
var save_method;
// var table;
$('#comment').DataTable
({
    "paging":true,
    "lengthChange":false,
    "searching":true,
    "ordering":true,
    "info":true,
    "autoWidth":false,
    "order":[[1,"desc"]]
});
</script>