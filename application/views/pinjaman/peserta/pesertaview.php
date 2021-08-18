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

<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>No</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Bagian</th>
		<th>Pinjaman</th>
		<th>Status</th>
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
				$pid=$row->peserta_id;
			?>
			<tr>
				<td><?php echo "$no" ;?></td>
				<td><?=$row->nip;?></td>				
				<td><?=$row->nama;?></td>
				<td><?=$row->bagian;?></td>				
				<td><?=$row->judul;?></td>
				<td><?=ucwords($row->status);?></td>
				<td>					
					<a onclick="return confirm('Yakin ingin menghapus karyawan ini?');" href="<?=base_url('/pinjaman/peserta/delete');?>?peserta=<?=$pid;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>