<?php
foreach($data as $row){	
}
$pinjamanid=$row->pinjaman_id;
$pinjamanID=$pinjamanid;
?>

<table class="table table-bordered">
<thead>
<hr width="100%">
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
				<td>(<?=$NIP.") ".$nama;?></td>
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
echo "Di cetak pada ";
$array_hari=array(1=>"senin","selasa","rabu","kamis","jumat","sabtu","minggu");
$hari=$array_hari[date("N")];
$tanggal=date("j");
$array_bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bulan=$array_bulan[date("n")];
$tahun=date("Y");
			
echo $hari.",".$tanggal.$bulan.$tahun;?>