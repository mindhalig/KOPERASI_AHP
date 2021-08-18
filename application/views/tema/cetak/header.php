<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$judul;?></title>
	<link rel="shortcut icon" href="<?php echo base_url('konten/RPI.bmp');?>" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=base_url();?>konten/fonts/css/fonts.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/font-awesome/css/font-awesome.min.css">    
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/dist/css/AdminLTE.min.css">
  </head>
  <body onload="window.print();">
  <div class="container">
  <h3 class="text-center">
  <?php
	echo img('assets/RPI.bmp');
   ?>
   <?=$judul;?>
  </h3>