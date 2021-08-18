
<?php
if(empty($data))
{
	redirect(base_url('pinjaman/pinjaman'));
}
foreach($data as $row){	
}
$pinjamanid=$row->pinjaman_id;
$pinjamanID=$pinjamanid;
?>
<script type="text/javascript">
function proseshitung()
{
	$.ajax({
		type:'get',
		dataType:'json',
		url:"<?=base_url('pinjaman/pinjaman/proseshitung');?>",
		data:"id=<?=$pinjamanid;?>",
		error:function(){
			$("#respon").html('Proses hitung seleksi pinjaman gagal');
			$("#error").show();
		},
		beforeSend:function(){
			$("#error").hide();
			$("#respon").html("Sedang bekerja, tunggu sebentar");
		},
		success:function(x){
			if(x.status=="ok")
			{
				alert('Proses seleksi berhasil. Halaman akan direfresh');
				window.location=window.location;
			}else{
				$("#respon").html('Proses hitung seleksi pinjaman gagal');
				$("#error").show();
			}
		},
	});
}
</script>

<div id="respon" class="hidden-print"></div>
<?php
$sql="Select COUNT(*) as m FROM peserta Where pinjaman_id='$pinjamanid' AND status IN ('lolos','tidaklolos')";
$c=$this->m_db->get_query_row($sql,'m');
if($c < 1)
{
	echo '<div class="alert alert-warning hidden-print" id="error">Pinjaman koperasi belum diproses. Klik <a href="javascript:;" onclick="proseshitung();">di sini</a> untuk proses</div>';
}else{	
?>
<a href="<?=base_url('laporan/penerimapinjaman');?>?id=<?=$pinjamanid;?>" target="_blank" class="btn btn-default btn-md hidden-print"><i class="fa fa-print"></i> Cetak</a>
<a href="javascript:;" onclick="proseshitung();" class="btn btn-primary btn-md">Ulangi Proses Hitung</a>
<table class="table table-bordered">
<thead>
	<th>Nama Karyawan</th>
	<?php
	$dKriteria=$this->mod_kriteria->kriteria_data();
	if(!empty($dKriteria))
	{
		foreach($dKriteria as $rKriteria)
		{
			echo '<th>'.$rKriteria->nama_kriteria.'</th>';
		}
	}
	?>
	<th>Total</th>
	<th>Status</th>
</thead>
<?php
$s=array(
'pinjaman_id'=>$pinjamanID,
);
if($this->m_db->is_bof('pinjaman',$s)==FALSE)
{
	$dPeserta=$this->m_db->get_data('peserta',$s);
	if(!empty($dPeserta))
	{
		
		foreach($dPeserta as $rPeserta)
		{
			$pesertaID=$rPeserta->peserta_id;
			$karyawanID=$rPeserta->karyawan_id;
			$NIP=field_value('karyawan','karyawan_id',$karyawanID,'nip');
			$nama=field_value('karyawan','karyawan_id',$karyawanID,'nama');
			
			?>
			<tr>
				<td>( <?=$NIP.") ".$nama;?></td>
				<?php
				$total=0;
				if(!empty($dKriteria))
				{
					foreach($dKriteria as $rKriteria)
					{						
						$kriteriaid=$rKriteria->kriteria_id;
						$subkriteria=peserta_nilai($pesertaID,$kriteriaid);
						$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
						$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
						$prioritas=ambil_prioritas($pinjamanid,$subkriteria);
						$total+=$prioritas;
						echo '<td>'.number_format($prioritas,3).'</td>';
					}
				}
				?>
				<td><?=number_format($total,3);?></td>
				<td><?=ucwords($rPeserta->status);?></td>
			</tr>			
			<?php
			
		}
		
	}else{
		return false;
	}
	
}else{
	return false;
}
?>
</table>
<?php
}
?>