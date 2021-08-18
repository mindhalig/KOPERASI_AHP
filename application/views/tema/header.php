<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$judul;?></title>
	<link rel="shortcut icon" href="<?php echo base_url('konten/RPI.bmp');?>" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url();?>konten/fonts/css/fonts.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/font-awesome/css/font-awesome.min.css">    
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?=base_url();?>konten/tema/lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function () {
		if($("#message_header").length)
		{
			setTimeout(function(){
				$("#message_header").hide("fade");
			},3000);
		}
	});
	</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url();?>/dashboard" class="logo">
          <!-- mini logo for sidebar mini 60x60 pixels -->
          <span class="logo-mini">RPI</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Koperasi</b><br>PT Randugarut Plastic Indonesia</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
			
          </a>
		  <div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
		  <p><h4>PT. Randugarut Plastic indonesia</h4></p>
		   </ul>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Log out</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                     <h1> Apakah anda ingin keluar ?</h1>
                    </p>
                  </li>                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=base_url();?>logout" class="btn btn-info">ya <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-off"></button></a>
                    </div>
                    <div class="pull-right">
					 <a href="<?=base_url();?>tu/dashboard" class="btn btn-info">Tidak</a>               
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <button class="btn btn-success"><h3><span class="glyphicon glyphicon-user"></span></i></h3>
            </div>
            <div class="pull-left info">
              <p><h2><?=user_info('nama');?></h2></p>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="treeview">
              <a href="<?=base_url('/dashboard');?>">
                <i class="glyphicon glyphicon-home"></i> <span>Home</span>
              </a>              
            </li>
			 <li class="treeview">
			  <a href="<?=base_url('/Karyawan');?>">
                <i class="fa fa-users"></i> <span>Karyawan</span>
              </a>  
			  </li>
            <?php            
			require_once APPPATH.'views/'.'/nav.php';
			$output='';
			foreach($menu as $m1=>$r1)
			{	
				$a=menu_active($r1['slug']);
				$s1="";
				$s2="";
				if($a==TRUE)
				{
					$s1="active";
					$s2="treeview";
				}
				if(empty($r1['child']))
				{
					$output.='<li class="treeview '.$s1.'">
					<a href="'.$r1['url'].'">							
						<i class="'.$r1['icon'].'"></i> <span>'.$m1.'</span>
					</a></li>';
				}else{
					$output.='<li class="treeview '.$s1.'">';
					$output.='<a href="#" data-toggle="dropdown">
						<i class="'.$r1['icon'].'"></i> <span>'.$m1.'</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>';
					$output.='<ul class="treeview-menu">';
					foreach($r1['child'] as $m2=>$r2)
					{
						$output.='<li><a href="'.$r2['url'].'">'.$m2.'</a></li>';
					}
					$output.='</ul>';
					$output.='</li>';
				}	
			}
			echo $output;
			?>
         
			<li class="treeview">
			  <a href="<?=base_url('/master/kriteria');?>">
                <i class="fa fa-code"></i> <span>Kriteria</span>
              </a>  
			 </li>
		 </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$judul;?>
          </h1>          
        </section>

        <!-- Main content -->
        <section class="content">
<?php
$msgHeader=$this->session->flashdata('message_header');
if(!empty($msgHeader))
{
$msgTipe=$msgHeader['tipe'];
$msgIcon="";
switch($msgTipe){
		case "danger":
			$msgIcon="fa-ban";
			break;						
		case "success":
			$msgIcon="fa-check";
			break;
		case "warning":
			$msgIcon="fa-warning";
			break;
		case "info":
			$msgIcon="fa-info";
			break;
	}
?>
<div class="alert alert-<?=$msgTipe;?> alert-dismissable" id="message_header">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><?=$msgHeader['title'];?></h4>
    <?=$msgHeader['message'];?>
</div>				                
<?php	
}
?>
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">              
            </div>
            <div class="box-body">
              
            
