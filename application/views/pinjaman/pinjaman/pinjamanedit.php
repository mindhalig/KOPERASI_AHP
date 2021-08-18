<?php
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url('pinjaman/pinjaman/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="pinjamanid" value="<?=$row->pinjaman_id;?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Judul</label>
	<div class="col-md-9">
		<input type="text" name="judul" id="" class="form-control " autocomplete="" placeholder="Judul Pinjaman" required="" value="<?php echo set_value('judul',$row->judul); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Kuota</label>
	<div class="col-md-3">
		<input type="number" name="kuota" id="" class="form-control " autocomplete="" placeholder="Kuota Pinjaman" required="" value="<?php echo set_value('kuota',$row->kuota); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Update</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
<?php
echo form_close();
?>