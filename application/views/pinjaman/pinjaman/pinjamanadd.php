<?php
echo validation_errors();
echo form_open(base_url('pinjaman/pinjaman/add'),array('class'=>'form-horizontal'));
?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Judul</label>
	<div class="col-md-9">
		<input type="text" name="judul" id="" class="form-control " autocomplete="" placeholder="Judul Pinjaman" required="" value="<?php echo set_value('judul'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Kuota</label>
	<div class="col-md-3">
		<input type="number" name="kuota" id="" class="form-control " autocomplete="" placeholder="Kuota Pinjaman" required="" value="<?php echo set_value('kuota'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
<?php
echo form_close();
?>