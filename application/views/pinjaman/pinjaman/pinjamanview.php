<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#datatable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
});
</script>
<div>
	<a href="<?=base_url('pinjaman/pinjaman/add');?>" class="btn btn-primary btn-flat"><button class="btn btn-success"><span class="glyphicon glyphicon-plus"></button> Tambah Pinjaman</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>No</th>
		<th>Judul</th>
		<th>Kuota</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		$no = 0 ;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$no++;
				$id=$row->pinjaman_id;
			?>
			<tr>
				<td><?php echo "$no" ;?></td>
				<td><?=$row->judul;?></td>				
				<td><?=$row->kuota;?></td>
				<td>
					<a href="<?=base_url('pinjaman/pinjaman/proses');?>?id=<?=$id;?>" class="btn btn-xs btn-success">Penerima</a> 
					<a href="<?=base_url('pinjaman/pinjaman/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-info">Edit</a>
					<a onclick="return confirm('Yakin ingin menghapus pinjaman :<?=$row->judul;?> ini?');" href="<?=base_url('pinjaman/pinjaman/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger">Delete</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>