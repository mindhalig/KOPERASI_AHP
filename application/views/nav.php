<?php

$menu=array(
	'Pinjaman'=>array(		
		'icon'=>'fa fa-money',
		'slug'=>'pinjaman',
		'child'=>array(
				'Semua pinjaman'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url()."pinjaman/pinjaman",
					'target'=>"",
					),
				'Kriteria Pinjaman'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url()."pinjaman/kriteria",
					'target'=>"",
					),
				'Pengajuan peminjam'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url()."pinjaman/peserta/add",
					'target'=>"",
					),
				'Daftar Peserta Pinjaman'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url()."pinjaman/peserta",
					'target'=>"",
					),	
				
					
			),
		
	),
	
);
?>