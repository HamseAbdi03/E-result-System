<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-danger">
		<div class="card-header">
			<div class="card-tools">
				<!-- <a class="btn btn-block btn-sm btn-default btn-flat border-danger new_class" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a> -->
			</div>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="60%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Semester</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT *,concat(curriculum) as `class` FROM class_list order by class asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['class'] ?></b></td>
					
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.new_class').click(function(){
			uni_modal("New class","<?php echo $_SESSION['login_view_folder'] ?>manage_class.php")
		})
		$('.manage_class').click(function(){
			uni_modal("Manage class","<?php echo $_SESSION['login_view_folder'] ?>manage_class.php?id="+$(this).attr('data-id'))
		})
	$('.delete_class').click(function(){
	_conf("Are you sure to delete this class?","delete_class",[$(this).attr('data-id')])
	})
	})
	function delete_class($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_class',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>