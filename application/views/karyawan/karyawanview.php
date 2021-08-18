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
	<a href="<?=base_url('karyawan/add');?>" class="btn btn-primary btn-md"><button class="btn btn-success"><span class="glyphicon glyphicon-plus"></button> Tambah Karyawan</a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>No</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Jenis Kelamin</th>
		<th>Bagian</th>
	
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
				$id=$row->karyawan_id;
			?>
			<tr>
			
				<td><?php echo "$no" ;?></td>
				<td><?=$row->nip;?></td>				
				<td><?=$row->nama;?></td>
				<td><?=$row->jenkel;?></td>				
				<td><?=$row->bagian;?></td>             
			
				<td>
					<a href="<?=base_url('/Karyawan/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a onclick="return confirm('Yakin ingin menghapus Karyawan : <?=$row->nama;?> ini?');" href="<?=base_url('/karyawan/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>