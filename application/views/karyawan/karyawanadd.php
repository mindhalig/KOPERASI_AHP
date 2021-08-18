<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/jquery-ui.min.css"/>
<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/themes/overcast/jquery-ui.min.css"/>
<script src="<?=base_url();?>konten/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	if($(".tanggal").length)
	{
		$(".tanggal").datepicker({
			dateFormat: "yy-mm-dd",
			showAnim:"slide",
			changeMonth: true,
			changeYear: true,
			yearRange:'c-70:c+10',
		});
	}
});
</script>
<?php
echo validation_errors();
echo form_open(base_url('karyawan/add'),array('class'=>'form-horizontal'));
?>
<div class="col-md-6">
<h3 class="heading-c">Biodata</h3>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">NIP</label>
	<div class="col-md-5">
		<input type="text" name="nip" id="" class="form-control " autocomplete="" placeholder="NIP Karyawan" required="" value="<?php echo set_value('nip'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">Nama Karyawan</label>
	<div class="col-md-9">
		<input type="text" name="nama" id="" class="form-control " autocomplete="" placeholder="Nama Karyawan" required="" value="<?php echo set_value('nama'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">Gender</label>
	<div class="col-md-7">
		<?php
		$arr=array('pria','wanita');
		foreach($arr as $r)
		{
		?>
		<div class="radio">
			<label>
				<input type="radio" name="jk" value="<?=$r;?>"/> <?=ucfirst($r);?>
			</label>
		</div>		
		<?php
		}
		?>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label" for="">Bagian</label>
	<div class="col-md-9">
		<input type="text" name="bagian" id="" class="form-control " autocomplete="" placeholder="Bagian" required="" value="<?php echo set_value('bagian'); ?>"/>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
</div>



	
	

</div>
<?php
echo form_close();
?>